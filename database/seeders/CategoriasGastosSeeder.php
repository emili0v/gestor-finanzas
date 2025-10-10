<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaGasto;

class CategoriasGastosSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Transporte',
                'icono' => 'bi-bus-front',
                'color' => '#3B82F6',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Alimentación',
                'icono' => 'bi-cart',
                'color' => '#10B981',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Salud',
                'icono' => 'bi-heart-pulse',
                'color' => '#EF4444',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Educación',
                'icono' => 'bi-book',
                'color' => '#8B5CF6',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Entretenimiento',
                'icono' => 'bi-controller',
                'color' => '#F59E0B',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Servicios Básicos',
                'icono' => 'bi-lightning',
                'color' => '#6366F1',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Vivienda',
                'icono' => 'bi-house',
                'color' => '#14B8A6',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Ropa y Calzado',
                'icono' => 'bi-bag',
                'color' => '#EC4899',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Ahorro',
                'icono' => 'bi-piggy-bank',
                'color' => '#22C55E',
                'es_predefinida' => true,
            ],
            [
                'nombre' => 'Otros',
                'icono' => 'bi-three-dots',
                'color' => '#6B7280',
                'es_predefinida' => true,
            ],
        ];

        foreach ($categorias as $categoria) {
            // USAR updateOrCreate en lugar de create
            CategoriaGasto::updateOrCreate(
                ['nombre' => $categoria['nombre']], // Buscar por nombre
                $categoria // Actualizar o crear con estos datos
            );
        }

        $this->command->info('Categorías de gastos creadas/actualizadas exitosamente');
    }
}