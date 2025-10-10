<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaGasto extends Model
{
    use HasFactory;

    protected $table = 'alertas_gastos';

    public $timestamps = false; // Usa solo fecha_generacion y fecha_lectura

    protected $fillable = [
        'perfil_usuario_id',
        'periodo',
        'umbral_alcanzado',
        'nivel',
        'porcentaje_actual',
        'saldo_restante',
        'mensaje',
        'leida',
        'fecha_generacion',
        'fecha_lectura',
    ];

    protected $casts = [
        'porcentaje_actual' => 'decimal:2',
        'saldo_restante' => 'decimal:2',
        'leida' => 'boolean',
        'fecha_generacion' => 'datetime',
        'fecha_lectura' => 'datetime',
    ];

    // Relación: Una alerta pertenece a un perfil
    public function perfilUsuario()
    {
        return $this->belongsTo(PerfilUsuario::class);
    }

    // Scope: Alertas no leídas
    public function scopeNoLeidas($query)
    {
        return $query->where('leida', false);
    }

    // Método: Marcar como leída
    public function marcarComoLeida()
    {
        $this->update([
            'leida' => true,
            'fecha_lectura' => now(),
        ]);
    }

    // Método helper: Generar mensaje de alerta
    public static function generarMensaje($nivel, $porcentaje, $saldo)
    {
        $mensajes = [
            'informacion' => "Has gastado el {$porcentaje}% de tu sueldo. Te quedan " . formatCLP($saldo) . " disponibles.",
            'advertencia' => "⚠️ Atención: Has gastado el {$porcentaje}% de tu sueldo. Solo te quedan " . formatCLP($saldo) . ".",
            'critico' => "🚨 ALERTA CRÍTICA: Has gastado el {$porcentaje}% de tu sueldo. Solo te quedan " . formatCLP($saldo) . ". ¡Controla tus gastos!",
        ];

        return $mensajes[$nivel] ?? '';
    }
}