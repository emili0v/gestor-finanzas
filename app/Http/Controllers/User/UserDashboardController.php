<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function miSueldo(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;

        $sueldoData = [
            'empleado_nombre' => $empleado->nombre ?? 'Usuario',
            'mes_actual' => now()->format('F Y'),
            'sueldo_bruto' => 850000,
            'descuentos' => [
                'AFP' => 85000,
                'Salud' => 68000,
                'Impuestos' => 45000,
            ],
            'bonos' => [
                'Productividad' => 50000,
                'Asistencia' => 25000,
            ],
            'total_descuentos' => 198000,
            'total_bonos' => 75000,
            'sueldo_liquido' => 727000,
        ];

        return view('app.mi-sueldo', compact('sueldoData'));
    }
}
