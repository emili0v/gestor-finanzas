<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserGoalsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;

        $metasData = [
            'meta_mensual' => 100000,
            'ahorro_actual' => 65000,
            'progreso_porcentaje' => 65,
            'meses_ahorrando' => 8,
            'total_ahorrado' => 520000,
            'meta_anual' => 1200000,
            'progreso_anual' => 43,
            'proyeccion_fin_ano' => 780000,
        ];

        $historialMetas = [
            ['mes' => 'Agosto 2024', 'meta' => 100000, 'ahorrado' => 85000, 'cumplida' => false],
            ['mes' => 'Julio 2024', 'meta' => 100000, 'ahorrado' => 120000, 'cumplida' => true],
            ['mes' => 'Junio 2024', 'meta' => 100000, 'ahorrado' => 95000, 'cumplida' => false],
            ['mes' => 'Mayo 2024', 'meta' => 100000, 'ahorrado' => 110000, 'cumplida' => true],
        ];

        return view('app.metas', compact('metasData', 'historialMetas', 'empleado'));
    }
}
