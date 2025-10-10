<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MetaAhorro;
use App\Models\PerfilUsuario;
use Illuminate\Http\Request;

class MetaAhorroController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado) {
            return redirect()->route('app.mi-sueldo')->with('error', 'No tienes un perfil de empleado asociado.');
        }

        $perfil = PerfilUsuario::firstOrCreate(['empleado_id' => $empleado->id]);

        $metasActivas = MetaAhorro::where('perfil_usuario_id', $perfil->id)
            ->where('estado', 'en_progreso')
            ->orderBy('created_at', 'desc')
            ->get();

        $metasCompletadas = MetaAhorro::where('perfil_usuario_id', $perfil->id)
            ->where('estado', 'completada')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // Calcular totales
        $totalAhorradoActivo = $metasActivas->sum('monto_actual');
        $totalObjetivoActivo = $metasActivas->sum('monto_objetivo');
        $progresoGeneral = $totalObjetivoActivo > 0 
            ? round(($totalAhorradoActivo / $totalObjetivoActivo) * 100, 1) 
            : 0;

        return view('app.metas', compact(
            'metasActivas',
            'metasCompletadas',
            'empleado',
            'perfil',
            'totalAhorradoActivo',
            'totalObjetivoActivo',
            'progresoGeneral'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_meta' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'monto_objetivo' => 'required|numeric|min:1',
            'fecha_objetivo' => 'nullable|date|after_or_equal:today',
        ], [
            'nombre_meta.required' => 'El nombre de la meta es obligatorio.',
            'monto_objetivo.required' => 'El monto objetivo es obligatorio.',
            'monto_objetivo.numeric' => 'El monto debe ser un número válido.',
            'monto_objetivo.min' => 'El monto debe ser mayor a 0.',
            'fecha_objetivo.after_or_equal' => 'La fecha objetivo no puede ser en el pasado.',
        ]);

        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado) {
            return redirect()->back()->with('error', 'No tienes un perfil de empleado asociado.');
        }

        $perfil = PerfilUsuario::firstOrCreate(['empleado_id' => $empleado->id]);

        MetaAhorro::create([
            'perfil_usuario_id' => $perfil->id,
            'nombre_meta' => $request->nombre_meta,
            'descripcion' => $request->descripcion,
            'monto_objetivo' => $request->monto_objetivo,
            'fecha_inicio' => now(),
            'fecha_objetivo' => $request->fecha_objetivo,
        ]);

        return redirect()->route('app.metas')->with('success', 'Meta de ahorro creada exitosamente');
    }

    public function update(Request $request, MetaAhorro $meta)
    {
        $request->validate([
            'monto_agregar' => 'required|numeric|min:0.01',
        ], [
            'monto_agregar.required' => 'Debes ingresar un monto.',
            'monto_agregar.numeric' => 'El monto debe ser un número válido.',
            'monto_agregar.min' => 'El monto debe ser mayor a 0.',
        ]);

        $meta->agregarAhorro($request->monto_agregar);

        return redirect()->route('app.metas')->with('success', 'Ahorro agregado exitosamente');
    }

    public function destroy(MetaAhorro $meta)
    {
        $meta->update(['estado' => 'cancelada']);
        
        return redirect()->route('app.metas')->with('success', 'Meta cancelada exitosamente');
    }
}