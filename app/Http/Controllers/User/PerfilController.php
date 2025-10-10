<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PerfilUsuario;
use App\Models\ConfiguracionAlerta;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado) {
            return redirect()->route('app.mi-sueldo')->with('error', 'No tienes un perfil de empleado asociado.');
        }

        $perfil = PerfilUsuario::firstOrCreate(['empleado_id' => $empleado->id]);
        $configuracion = ConfiguracionAlerta::firstOrCreate(
            ['perfil_usuario_id' => $perfil->id],
            [
                'umbral_informacion' => 50,
                'umbral_advertencia' => 70,
                'umbral_critico' => 90,
            ]
        );

        return view('app.perfil-configuracion', compact('perfil', 'configuracion', 'empleado'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'umbral_informacion' => 'required|integer|min:1|max:100',
            'umbral_advertencia' => 'required|integer|min:1|max:100',
            'umbral_critico' => 'required|integer|min:1|max:100',
        ]);

        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado) {
            return redirect()->back()->with('error', 'No tienes un perfil de empleado asociado.');
        }

        $perfil = PerfilUsuario::firstOrCreate(['empleado_id' => $empleado->id]);
        
        $perfil->update([
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'region' => $request->region,
        ]);

        $configuracion = ConfiguracionAlerta::firstOrCreate(['perfil_usuario_id' => $perfil->id]);
        
        $configuracion->update([
            'umbral_informacion' => $request->umbral_informacion,
            'umbral_advertencia' => $request->umbral_advertencia,
            'umbral_critico' => $request->umbral_critico,
        ]);

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
    }
}