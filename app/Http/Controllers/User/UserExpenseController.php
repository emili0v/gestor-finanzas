<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;

        $gastosData = [
            [
                'id' => 1,
                'fecha' => '2024-09-15',
                'categoria' => 'Transporte',
                'descripcion' => 'Pasaje metro',
                'monto' => 1500,
            ],
            [
                'id' => 2,
                'fecha' => '2024-09-14',
                'categoria' => 'Alimentación',
                'descripcion' => 'Almuerzo',
                'monto' => 8500,
            ],
            [
                'id' => 3,
                'fecha' => '2024-09-13',
                'categoria' => 'Salud',
                'descripcion' => 'Farmacia',
                'monto' => 12000,
            ],
            [
                'id' => 4,
                'fecha' => '2024-09-12',
                'categoria' => 'Educación',
                'descripcion' => 'Curso online',
                'monto' => 25000,
            ],
        ];

        $categorias = ['Transporte', 'Alimentación', 'Salud', 'Educación', 'Otros'];

        return view('app.gastos', compact('gastosData', 'categorias', 'empleado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string',
            'monto' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
        ]);

        return redirect()->route('app.gastos')->with('success', 'Gasto agregado exitosamente');
    }
}
