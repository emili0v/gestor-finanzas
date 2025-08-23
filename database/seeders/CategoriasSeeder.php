<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Alimentación', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Transporte', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Salud', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vivienda', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Entretenimiento', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

