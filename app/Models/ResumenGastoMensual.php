<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumenGastoMensual extends Model
{
    use HasFactory;

    protected $table = 'resumen_gastos_mensuales';

    public $timestamps = false; // Usa solo actualizado_en

    protected $fillable = [
        'perfil_usuario_id',
        'periodo',
        'sueldo_liquido',
        'total_gastado',
        'porcentaje_gastado',
        'saldo_disponible',
        'actualizado_en',
    ];

    protected $casts = [
        'sueldo_liquido' => 'decimal:2',
        'total_gastado' => 'decimal:2',
        'porcentaje_gastado' => 'decimal:2',
        'saldo_disponible' => 'decimal:2',
        'actualizado_en' => 'datetime',
    ];

    // Relación: Un resumen pertenece a un perfil
    public function perfilUsuario()
    {
        return $this->belongsTo(PerfilUsuario::class);
    }

    // Método helper: Calcular y actualizar resumen
    public static function calcularResumen($perfilUsuarioId, $periodo, $sueldoLiquido)
    {
        $totalGastado = GastoPersonal::where('perfil_usuario_id', $perfilUsuarioId)
            ->where('mes_referencia', $periodo)
            ->sum('monto');

        $porcentajeGastado = $sueldoLiquido > 0 ? ($totalGastado / $sueldoLiquido) * 100 : 0;
        $saldoDisponible = $sueldoLiquido - $totalGastado;

        return self::updateOrCreate(
            [
                'perfil_usuario_id' => $perfilUsuarioId,
                'periodo' => $periodo,
            ],
            [
                'sueldo_liquido' => $sueldoLiquido,
                'total_gastado' => $totalGastado,
                'porcentaje_gastado' => round($porcentajeGastado, 2),
                'saldo_disponible' => $saldoDisponible,
                'actualizado_en' => now(),
            ]
        );
    }
}