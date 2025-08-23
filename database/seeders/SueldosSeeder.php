<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SueldosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sueldos')->insert([
            ['empleado_id' => 1, 'monto' => 1200000, 'fecha' => '2025-01-01', 'created_at' => now(), 'updated_at' => now()],
            ['empleado_id' => 2, 'monto' => 950000, 'fecha' => '2025-01-01', 'created_at' => now(), 'updated_at' => now()],
            ['empleado_id' => 3, 'monto' => 800000, 'fecha' => '2025-01-01', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
