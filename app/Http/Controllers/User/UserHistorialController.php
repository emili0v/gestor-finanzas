<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserHistorialController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;

        $historialData = [
            [
                'mes' => 'Agosto 2024',
                'sueldo_bruto' => 850000,
                'sueldo_liquido' => 727000,
                'fecha_pago' => '2024-08-30',
                'estado' => 'Pagado',
                'pdf_disponible' => true,
            ],
            [
                'mes' => 'Julio 2024',
                'sueldo_bruto' => 820000,
                'sueldo_liquido' => 702000,
                'fecha_pago' => '2024-07-30',
                'estado' => 'Pagado',
                'pdf_disponible' => true,
            ],
            [
                'mes' => 'Junio 2024',
                'sueldo_bruto' => 850000,
                'sueldo_liquido' => 727000,
                'fecha_pago' => '2024-06-28',
                'estado' => 'Pagado',
                'pdf_disponible' => true,
            ],
            [
                'mes' => 'Mayo 2024',
                'sueldo_bruto' => 850000,
                'sueldo_liquido' => 727000,
                'fecha_pago' => '2024-05-31',
                'estado' => 'Pagado',
                'pdf_disponible' => false,
            ],
        ];

        return view('app.historial', compact('historialData', 'empleado'));
    }
}
