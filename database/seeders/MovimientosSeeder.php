<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movimiento;
use App\Models\Categoria;

class MovimientosSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener categorías creadas
        $bonoPorDesempeno = Categoria::where('nombre', 'Bono Desempeño')->first();
        $horasExtra = Categoria::where('nombre', 'Horas Extra')->first();
        $adelantoSueldo = Categoria::where('nombre', 'Adelanto de Sueldo')->first();
        $descuentoInasistencia = Categoria::where('nombre', 'Descuento por Inasistencia')->first();

        // === BONOS (MOVIMIENTOS POSITIVOS) ===
        
        // Bono por desempeño para empleado 1 (Juan Pérez)
        Movimiento::create([
            'empleado_id' => 1,
            'categoria_id' => $bonoPorDesempeno->id,
            'monto' => 50000, // El mutator convierte a centavos automáticamente
            'descripcion' => 'Bono por excelente evaluación de huéspedes durante el mes',
            'fecha' => now()->subDays(5),
        ]);

        // Horas extra para empleado 2 (María González)
        Movimiento::create([
            'empleado_id' => 2,
            'categoria_id' => $horasExtra->id,
            'monto' => 35000,
            'descripcion' => 'Horas extra trabajadas durante evento de fin de año',
            'fecha' => now()->subDays(3),
        ]);

        // === DESCUENTOS (MOVIMIENTOS NEGATIVOS) ===
        
        // Adelanto de sueldo para empleado 2 (María González)
        Movimiento::create([
            'empleado_id' => 2,
            'categoria_id' => $adelantoSueldo->id,
            'monto' => -75000, // Negativo para descuentos
            'descripcion' => 'Adelanto de quincena solicitado por el empleado',
            'fecha' => now()->subDays(7),
        ]);

        // Descuento por inasistencia para empleado 1 (Juan Pérez)
        Movimiento::create([
            'empleado_id' => 1,
            'categoria_id' => $descuentoInasistencia->id,
            'monto' => -25000, // Negativo para descuentos
            'descripcion' => 'Descuento por día no trabajado sin justificación',
            'fecha' => now()->subDays(10),
        ]);

        // Más ejemplos para tener datos de prueba
        
        // Bono adicional
        Movimiento::create([
            'empleado_id' => 1,
            'categoria_id' => $horasExtra->id,
            'monto' => 42000,
            'descripcion' => 'Horas extra por cobertura en recepción nocturna',
            'fecha' => now()->subDays(12),
        ]);

        // Descuento adicional
        if ($adelantoSueldo) {
            Movimiento::create([
                'empleado_id' => 1,
                'categoria_id' => $adelantoSueldo->id,
                'monto' => -50000,
                'descripcion' => 'Adelanto para gastos médicos familiares',
                'fecha' => now()->subDays(15),
            ]);
        }
    }
}