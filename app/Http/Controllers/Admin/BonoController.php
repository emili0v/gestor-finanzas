<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Movimiento;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BonoController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now();
        $inicioMes = $mesActual->copy()->startOfMonth();
        $finMes = $mesActual->copy()->endOfMonth();

        // Métricas del mes actual
        $bonosDelMes = Movimiento::whereBetween('created_at', [$inicioMes, $finMes])
                                ->where('monto', '>', 0)
                                ->sum('monto');

        $totalBonos = Movimiento::where('monto', '>', 0)->count();

        // Lista de bonos (movimientos positivos) con información del empleado
        $bonos = Movimiento::with(['empleado', 'categoria'])
                          ->where('monto', '>', 0)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('ingresos.index', compact('bonosDelMes', 'totalBonos', 'bonos', 'mesActual'));
    }

    public function create()
    {
        $empleados = Empleado::with('role')->orderBy('nombre')->get();
        
        // Categorías específicas para bonos de hotel
        $categoriasBonos = [
            'Comisión por Tours',
            'Horas Extra',
            'Bono Ocupación',
            'Incentivo Puntualidad',
            'Bono Desempeño',
            'Comisión Ventas',
            'Bono Temporada Alta'
        ];

        return view('bonos.create', compact('empleados', 'categoriasBonos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'categoria_nombre' => 'required|string|max:255',
            'monto' => 'required|numeric|min:1',
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        // Buscar o crear la categoría
        $categoria = Categoria::firstOrCreate(['nombre' => $request->categoria_nombre]);

        // Crear el movimiento (bono)
        Movimiento::create([
            'empleado_id' => $request->empleado_id,
            'categoria_id' => $categoria->id,
            'monto' => abs($request->monto), // Asegurar que sea positivo
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('bonos.index')
                        ->with('success', 'Bono asignado exitosamente al empleado.');
    }

    public function show(Movimiento $bono)
    {
        $bono->load(['empleado', 'categoria']);
        return view('bonos.show', compact('bono'));
    }

    public function edit(Movimiento $bono)
    {
        $empleados = Empleado::with('role')->orderBy('nombre')->get();
        
        $categoriasBonos = [
            'Comisión por Tours',
            'Horas Extra',
            'Bono Ocupación',
            'Incentivo Puntualidad',
            'Bono Desempeño',
            'Comisión Ventas',
            'Bono Temporada Alta'
        ];

        return view('bonos.edit', compact('bono', 'empleados', 'categoriasBonos'));
    }

    public function update(Request $request, Movimiento $bono)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'categoria_nombre' => 'required|string|max:255',
            'monto' => 'required|numeric|min:1',
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        $categoria = Categoria::firstOrCreate(['nombre' => $request->categoria_nombre]);

        $bono->update([
            'empleado_id' => $request->empleado_id,
            'categoria_id' => $categoria->id,
            'monto' => abs($request->monto),
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('bonos.index')
                        ->with('success', 'Bono actualizado exitosamente.');
    }

    public function destroy(Movimiento $bono)
    {
        $bono->delete();
        
        return redirect()->route('bonos.index')
                        ->with('success', 'Bono eliminado exitosamente.');
    }
}