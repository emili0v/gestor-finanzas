<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;

        $perfilData = [
            'nombre' => $user->name,
            'email' => $user->email,
            'empleado_nombre' => $empleado->nombre ?? 'No asignado',
            'rut' => $empleado->rut_completo ?? 'No disponible',
            'rol' => $empleado->role->nombre ?? 'Sin rol',
            'fecha_ingreso' => $empleado->created_at ?? now(),
            'estado' => 'Activo',
        ];

        return view('app.perfil', compact('perfilData', 'user', 'empleado'));
    }
}
