<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        Empleado::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'departamento' => 'Administración',
            'cargo' => 'Gerente',
            'role_id' => 1 // Admin
        ]);

        Empleado::create([
            'nombre' => 'María',
            'apellido' => 'González',
            'departamento' => 'Recepción',
            'cargo' => 'Recepcionista',
            'role_id' => 2 // Empleado
        ]);
    }
}