<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        if (!$user || !$user->empleado || !$user->empleado->role) {
            return redirect()->route('login');
        }

        if ($user->empleado->role->nombre !== $role) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
