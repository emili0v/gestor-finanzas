<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sueldo;

class SueldosSeeder extends Seeder
{
    public function run(): void
    {
        // Asigna sueldos a los empleados de ejemplo creados en EmpleadosSeeder
        // Asegúrate de que los IDs de empleado (1, 2, 3...) existan
        Sueldo::create(['empleado_id' => 1, 'monto_bruto' => 1200000]); // Para Juan Pérez
        Sueldo::create(['empleado_id' => 2, 'monto_bruto' => 950000]);  // Para María González
    }
}