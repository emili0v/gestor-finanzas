<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movimiento;

class MovimientosSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos movimientos de ejemplo que SÍ corresponden a empleados existentes
        // y a las nuevas categorías.

        // Bono (ingreso) para el empleado 1 (Juan Pérez)
        Movimiento::create([
            'empleado_id' => 1,
            'categoria_id' => 2, // Corresponde a 'Bono por Desempeño'
            'monto' => 50000,
            'descripcion' => 'Bono mensual',
            'fecha' => now(),
        ]);

        // Descuento (egreso) para el empleado 2 (María González)
        Movimiento::create([
            'empleado_id' => 2,
            'categoria_id' => 6, // Corresponde a 'Adelanto de Sueldo'
            'monto' => -75000,
            'descripcion' => 'Adelanto de quincena',
            'fecha' => now(),
        ]);
    }
}