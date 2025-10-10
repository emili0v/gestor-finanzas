<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    use HasFactory;

    protected $table = 'perfiles_usuarios';

    protected $fillable = [
        'empleado_id',
        'telefono',
        'direccion',
        'ciudad',
        'region',
        'fecha_nacimiento',
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    // Relación: Un perfil pertenece a un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    // Relación: Un perfil tiene una configuración de alertas
    public function configuracionAlertas()
    {
        return $this->hasOne(ConfiguracionAlerta::class);
    }

    // Relación: Un perfil tiene muchos gastos
    public function gastos()
    {
        return $this->hasMany(GastoPersonal::class);
    }

    // Relación: Un perfil tiene muchos resúmenes mensuales
    public function resumenesGastos()
    {
        return $this->hasMany(ResumenGastoMensual::class);
    }

    // Relación: Un perfil tiene muchas alertas
    public function alertas()
    {
        return $this->hasMany(AlertaGasto::class);
    }

    // Relación: Un perfil tiene muchas metas de ahorro
    public function metas()
    {
        return $this->hasMany(MetaAhorro::class);
    }

    // Método helper: Obtener gastos del mes actual
    public function gastosDelMes()
    {
        return $this->gastos()
            ->where('mes_referencia', now()->format('Y-m'))
            ->orderBy('fecha', 'desc')
            ->get();
    }

    // Método helper: Obtener alertas no leídas
    public function alertasNoLeidas()
    {
        return $this->alertas()
            ->where('leida', false)
            ->orderBy('fecha_generacion', 'desc')
            ->get();
    }
}