<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaAhorro extends Model
{
    use HasFactory;

    protected $table = 'metas_ahorro';

    protected $fillable = [
        'perfil_usuario_id',
        'nombre_meta',
        'descripcion',
        'monto_objetivo',
        'monto_actual',
        'fecha_inicio',
        'fecha_objetivo',
        'estado',
    ];

    protected $casts = [
        'monto_objetivo' => 'decimal:2',
        'monto_actual' => 'decimal:2',
        'fecha_inicio' => 'date',
        'fecha_objetivo' => 'date',
    ];

    // Relación: Una meta pertenece a un perfil
    public function perfilUsuario()
    {
        return $this->belongsTo(PerfilUsuario::class);
    }

    // Accessor: Porcentaje de progreso
    public function getProgresoAttribute()
    {
        if ($this->monto_objetivo > 0) {
            return round(($this->monto_actual / $this->monto_objetivo) * 100, 2);
        }
        return 0;
    }

    // Accessor: Monto faltante
    public function getMontoPendienteAttribute()
    {
        return max(0, $this->monto_objetivo - $this->monto_actual);
    }

    // Método: Agregar ahorro
    public function agregarAhorro($monto)
    {
        $this->monto_actual += $monto;
        
        if ($this->monto_actual >= $this->monto_objetivo) {
            $this->estado = 'completada';
        }
        
        $this->save();
    }

    // Scope: Metas activas
    public function scopeActivas($query)
    {
        return $query->where('estado', 'en_progreso');
    }
}