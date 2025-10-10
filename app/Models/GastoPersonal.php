<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoPersonal extends Model
{
    use HasFactory;

    protected $table = 'gastos_personales';

    protected $fillable = [
        'perfil_usuario_id',
        'categoria_id',
        'monto',
        'descripcion',
        'fecha',
        'mes_referencia',
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2',
    ];

    // Relación: Un gasto pertenece a un perfil
    public function perfilUsuario()
    {
        return $this->belongsTo(PerfilUsuario::class);
    }

    // Relación: Un gasto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(CategoriaGasto::class);
    }

    // Automáticamente establecer mes_referencia al guardar
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gasto) {
            if (empty($gasto->mes_referencia) && !empty($gasto->fecha)) {
                $gasto->mes_referencia = \Carbon\Carbon::parse($gasto->fecha)->format('Y-m');
            }
        });
    }

    // Scope: Gastos de un mes específico
    public function scopeDelMes($query, $periodo)
    {
        return $query->where('mes_referencia', $periodo);
    }

    // Scope: Gastos del mes actual
    public function scopeMesActual($query)
    {
        return $query->where('mes_referencia', now()->format('Y-m'));
    }
}