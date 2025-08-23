<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('movimientos')->insert([
            ['empleado_id' => 1, 'categoria_id' => 1, 'monto' => -50000, 'descripcion' => 'Compra supermercado', 'fecha' => '2025-02-01', 'created_at' => now(), 'updated_at' => now()],
            ['empleado_id' => 2, 'categoria_id' => 2, 'monto' => -20000, 'descripcion' => 'Transporte público', 'fecha' => '2025-02-02', 'created_at' => now(), 'updated_at' => now()],
            ['empleado_id' => 3, 'categoria_id' => 3, 'monto' => -75000, 'descripcion' => 'Consulta médica', 'fecha' => '2025-02-03', 'created_at' => now(), 'updated_at' => now()],
            ['empleado_id' => 1, 'categoria_id' => 5, 'monto' => -30000, 'descripcion' => 'Salida al cine', 'fecha' => '2025-02-05', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
