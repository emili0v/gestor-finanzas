<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Maneja la solicitud de inicio de sesión.
     */
    public function login(Request $request)
    {
        // 1. Validar los datos de entrada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. Redirigir según el rol del usuario
            // Asume que role_id = 1 es Administrador
            if ($user->role_id == 1) {
                return redirect()->intended(route('dashboard'));
            }

            // Cualquier otro rol (ej. empleado) va a su panel
            return redirect()->intended(route('app.mi-sueldo'));
        }

        // 4. Si la autenticación falla, devolver con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }
}