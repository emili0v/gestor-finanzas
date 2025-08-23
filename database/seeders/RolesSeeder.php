<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Empleado', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Contador', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
