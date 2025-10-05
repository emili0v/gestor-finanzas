<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. ELIMINAR todos los roles antiguos (incluidos duplicados)
        DB::table('roles')->truncate();
        
        // 2. INSERTAR los 13 roles del Hotel Yatehue
        DB::table('roles')->insert([
            // Administración
            ['nombre' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Gerente General', 'created_at' => now(), 'updated_at' => now()],
            
            // Recepción
            ['nombre' => 'Recepcionista', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Conserje', 'created_at' => now(), 'updated_at' => now()],
            
            // Cocina y Restaurante
            ['nombre' => 'Chef', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ayudante de Cocina', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Mesero', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Bartender', 'created_at' => now(), 'updated_at' => now()],
            
            // Limpieza y mantenimiento
            ['nombre' => 'Camarera', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Mucama', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lavandería', 'created_at' => now(), 'updated_at' => now()],
            
            // Otros
            ['nombre' => 'Guía Turístico', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Conductor', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir: eliminar roles del hotel
        DB::table('roles')->truncate();
        
        // Restaurar roles antiguos
        DB::table('roles')->insert([
            ['nombre' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Empleado', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Contador', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};