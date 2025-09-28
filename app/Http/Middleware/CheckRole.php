<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Verificar el rol usando el campo 'role' directo
        if (auth()->user()->role !== $role) {
            // Si es admin intentando acceder a rutas de empleado
            if (auth()->user()->role === 'admin' && $role === 'user') {
                return redirect()->route('dashboard');
            }
            // Si es empleado intentando acceder a rutas de admin
            if (auth()->user()->role === 'user' && $role === 'admin') {
                return redirect()->route('app.mi-sueldo');
            }
        }
        
        return $next($request);
    }
}