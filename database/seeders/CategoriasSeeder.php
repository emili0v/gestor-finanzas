<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- CATEGORÍAS DE HABERES (TIPO: INGRESO) ---
        // Estas categorías coinciden exactamente con las del BonoController
        Categoria::create(['nombre' => 'Comisión por Tours', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Horas Extra', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Bono Ocupación', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Incentivo Puntualidad', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Bono Desempeño', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Comisión Ventas', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Bono Temporada Alta', 'tipo' => 'ingreso']);

        // --- CATEGORÍAS ADICIONALES DE INGRESO ---
        Categoria::create(['nombre' => 'Propina Registrada', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Asignación Especial', 'tipo' => 'ingreso']);

        // --- CATEGORÍAS DE DESCUENTOS (TIPO: EGRESO) ---
        Categoria::create(['nombre' => 'Adelanto de Sueldo', 'tipo' => 'egreso']);
        Categoria::create(['nombre' => 'Descuento por Inasistencia', 'tipo' => 'egreso']);
        Categoria::create(['nombre' => 'Daño a Propiedad de Hotel', 'tipo' => 'egreso']);
        Categoria::create(['nombre' => 'Cuota Préstamo Interno', 'tipo' => 'egreso']);
    }
}