<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        Empleado::create([
            'nombre' => 'Juan Pérez',
            'rut' => '12345678',
            'dig_verificador' => '9',
            'apellido' => 'García',
            'departamento' => 'Administración',
            'cargo' => 'Gerente',
            'role_id' => 1 // Admin
        ]);

        Empleado::create([
            'nombre' => 'María González',
            'rut' => '87654321',
            'dig_verificador' => 'K',
            'apellido' => 'López',
            'departamento' => 'Recepción',
            'cargo' => 'Recepcionista',
            'role_id' => 2 // Empleado
        ]);
    }
}