<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleados')->insert([
            [
                'nombre' => 'Juan Pérez',
                'rut' => '12345678',
                'dig_verificador' => '9',
                'role_id' => 1, // Administrador
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'María González',
                'rut' => '87654321',
                'dig_verificador' => 'K',
                'role_id' => 2, // Empleado
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Pedro López',
                'rut' => '11223344',
                'dig_verificador' => '7',
                'role_id' => 3, // Contador
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Ana Torres',
                'rut' => '22334455',
                'dig_verificador' => 'K',
                'role_id' => 2, // Empleado
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Carlos Ramírez',
                'rut' => '33445566',
                'dig_verificador' => '0',
                'role_id' => 3, // Contador
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
