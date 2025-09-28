<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Movimiento;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now();
        $inicioMes = $mesActual->copy()->startOfMonth();
        $finMes = $mesActual->copy()->endOfMonth();

        // Métricas del mes actual - descuentos (montos negativos)
        $descuentosDelMes = abs(Movimiento::whereBetween('created_at', [$inicioMes, $finMes])
                                ->where('monto', '<', 0)
                                ->sum('monto') / 100); // Convertir centavos a pesos

        $totalDescuentos = Movimiento::where('monto', '<', 0)->count();

        // Lista de descuentos (movimientos negativos) con información del empleado
        $descuentos = Movimiento::with(['empleado', 'categoria'])
                          ->where('monto', '<', 0)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('egresos.index', compact('descuentosDelMes', 'totalDescuentos', 'descuentos', 'mesActual'));
    }

    public function create()
    {
        $empleados = Empleado::with('role')->orderBy('nombre')->get();
        
        // Categorías específicas para descuentos de hotel
        $categoriasDescuentos = [
            'Adelanto de Sueldo',
            'Descuento por Inasistencia',
            'Daño a Propiedad de Hotel',
            'Cuota Préstamo Interno',
            'Descuento Uniforme',
            'Multa por Atraso',
            'Descuento Alimentación'
        ];

        return view('egresos.create', compact('empleados', 'categoriasDescuentos'));
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

        // Buscar o crear la categoría con tipo egreso
        $categoria = Categoria::firstOrCreate(
            ['nombre' => $request->categoria_nombre],
            ['tipo' => 'egreso']
        );

        // Crear el movimiento (descuento) - monto negativo
        Movimiento::create([
            'empleado_id' => $request->empleado_id,
            'categoria_id' => $categoria->id,
            'monto' => -abs($request->monto), // Asegurar que sea negativo
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('egresos.index')
                        ->with('success', 'Descuento aplicado exitosamente al empleado.');
    }

    public function show(Movimiento $descuento)
    {
        $descuento->load(['empleado', 'categoria']);
        return view('egresos.show', compact('descuento'));
    }

    public function edit(Movimiento $descuento)
    {
        $empleados = Empleado::with('role')->orderBy('nombre')->get();
        
        $categoriasDescuentos = [
            'Adelanto de Sueldo',
            'Descuento por Inasistencia',
            'Daño a Propiedad de Hotel',
            'Cuota Préstamo Interno',
            'Descuento Uniforme',
            'Multa por Atraso',
            'Descuento Alimentación'
        ];

        return view('egresos.edit', compact('descuento', 'empleados', 'categoriasDescuentos'));
    }

    public function update(Request $request, Movimiento $descuento)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'categoria_nombre' => 'required|string|max:255',
            'monto' => 'required|numeric|min:1',
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        $categoria = Categoria::firstOrCreate(
            ['nombre' => $request->categoria_nombre],
            ['tipo' => 'egreso']
        );

        $descuento->update([
            'empleado_id' => $request->empleado_id,
            'categoria_id' => $categoria->id,
            'monto' => -abs($request->monto), // Asegurar que sea negativo
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('egresos.index')
                        ->with('success', 'Descuento actualizado exitosamente.');
    }

    public function destroy(Movimiento $descuento)
    {
        $descuento->delete();
        
        return redirect()->route('egresos.index')
                        ->with('success', 'Descuento eliminado exitosamente.');
    }
}