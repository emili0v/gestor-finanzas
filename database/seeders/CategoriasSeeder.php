<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria; // Importante: Usar el modelo Categoria

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- CATEGORÍAS DE HABERES (TIPO: INGRESO) ---
        // Estos son los montos que se SUMAN al sueldo del empleado
        Categoria::create(['nombre' => 'Comisión por Venta', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Bono por Desempeño', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Propina Registrada', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Horas Extra', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Asignación Especial', 'tipo' => 'ingreso']);


        // --- CATEGORÍAS DE DESCUENTOS (TIPO: EGRESO) ---
        // Estos son los montos que se RESTAN del sueldo del empleado
        Categoria::create(['nombre' => 'Adelanto de Sueldo', 'tipo' => 'egreso']);
        Categoria::create(['nombre' => 'Descuento por Inasistencia', 'tipo' => 'egreso']);
        Categoria::create(['nombre' => 'Daño a Propiedad de Hotel', 'tipo' => 'egreso']);
        Categoria::create(['nombre' => 'Cuota Préstamo Interno', 'tipo' => 'egreso']);
    }
}
