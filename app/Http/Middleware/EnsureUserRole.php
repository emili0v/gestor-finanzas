<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Maneja la verificación de roles usando el campo directo 'role' de users.
     * Sistema simplificado y unificado.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        // Verificar que el usuario esté autenticado
        if (!$user) {
            return redirect()->route('login');
        }

        // Mapeo de roles para compatibilidad
        $roleMapping = [
            'Administrador' => 'admin',
            'Empleado' => 'user',
        ];

        // Convertir el rol solicitado si viene del sistema antiguo
        $expectedRole = $roleMapping[$role] ?? $role;

        // Verificar el rol usando el campo directo
        if ($user->role !== $expectedRole) {
            // Redirigir según el rol que tenga el usuario
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('app.mi-sueldo');
        }

        return $next($request);
    }
}