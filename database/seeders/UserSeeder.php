<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        //SIEMPRE crear usuario Admin (aunque no haya empleado asociado)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'empleado_id' => null, // No requiere empleado asociado
                'role' => 'admin'
            ]
        );

        // Crear usuario Empleado (solo si existe un empleado con role_id = 2)
        $empleado = Empleado::where('role_id', 2)->first();
        
        if ($empleado) {
            User::updateOrCreate(
                ['email' => 'empleado@example.com'],
                [
                    'name' => 'Empleado Demo',
                    'password' => Hash::make('password'),
                    'empleado_id' => $empleado->id,
                    'role' => 'user'
                ]
            );
        }

        // Crear usuario test sin empleado asociado
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Usuario Test',
                'password' => Hash::make('password'),
                'empleado_id' => null,
                'role' => 'user'
            ]
        );
        
        
        $this->command->info('✅ Usuarios creados con sistema de roles unificado:');
        $this->command->info('Admin: admin@example.com / password (role: admin)');
        $this->command->info('Empleado: empleado@example.com / password (role: user)');
        $this->command->info('Test: test@example.com / password (role: user)');
    }
}