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
        // Crear usuario Administrador
        $adminEmpleado = Empleado::where('role_id', 1)->first();
        
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'empleado_id' => $adminEmpleado ? $adminEmpleado->id : null,
                'role' => 'admin' // ✅ Sistema unificado
            ]
        );

        // Crear usuario Empleado
        $empleado = Empleado::where('role_id', 2)->first();
        
        User::updateOrCreate(
            ['email' => 'empleado@example.com'],
            [
                'name' => 'Empleado Demo',
                'password' => Hash::make('password'),
                'empleado_id' => $empleado ? $empleado->id : null,
                'role' => 'user' // ✅ Sistema unificado
            ]
        );

        // Crear usuario test sin empleado asociado
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Usuario Test',
                'password' => Hash::make('password'),
                'role' => 'user' // ✅ Sistema unificado
            ]
        );
        
        $this->command->info('✅ Usuarios creados con sistema de roles unificado:');
        $this->command->info('Admin: admin@example.com / password (role: admin)');
        $this->command->info('Empleado: empleado@example.com / password (role: user)');
        $this->command->info('Test: test@example.com / password (role: user)');
    }
}