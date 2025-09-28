<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Sueldo;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        
        // Cargar empleados con sus relaciones
        $empleados = Empleado::with(['role', 'sueldos'])->get();

        foreach ($empleados as $empleado) {
            // Calcular bonos y descuentos del mes actual
            $empleado->totalBonos = $empleado->movimientos()
                ->whereBetween('fecha', [$inicioMes, $finMes])
                ->where('monto', '>', 0)
                ->sum('monto');
                
            $empleado->totalDescuentos = abs($empleado->movimientos()
                ->whereBetween('fecha', [$inicioMes, $finMes])
                ->where('monto', '<', 0)
                ->sum('monto'));
                
            // Obtener sueldo más reciente
            $sueldoReciente = $empleado->sueldos()->latest()->first();
            $sueldoBruto = $sueldoReciente->monto ?? 0;
            
            $empleado->sueldoLiquido = $sueldoBruto + $empleado->totalBonos - $empleado->totalDescuentos;
        }
        
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        // Obtener todos los roles disponibles
        $roles = Role::all();
        return view('empleados.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validación corregida según tu estructura de BD
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rut' => 'required|string|max:20|unique:empleados,rut',
            'dig_verificador' => 'required|string|size:1',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'sueldo_bruto' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Crear el empleado con los campos correctos
                $empleado = Empleado::create([
                    'nombre' => $request->nombre,
                    'rut' => str_replace(['.', '-'], '', $request->rut), // Limpiar RUT
                    'dig_verificador' => strtoupper($request->dig_verificador),
                    'role_id' => $request->role_id,
                ]);

                // 2. Crear el usuario asociado
                User::create([
                    'name' => $request->nombre,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'empleado_id' => $empleado->id,
                ]);

                // 3. Crear el sueldo inicial
                Sueldo::create([
                    'empleado_id' => $empleado->id,
                    'monto_bruto' => $request->sueldo_bruto, 
                ]);
            });

            return redirect()->route('empleados.index')
                           ->with('success', 'Empleado creado exitosamente.');
                           
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['error' => 'Error al crear empleado: ' . $e->getMessage()])
                           ->withInput();
        }
    }

    public function show(Empleado $empleado)
    {
        $empleado->load(['role', 'sueldos', 'movimientos.categoria']);
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        $roles = Role::all();
        return view('empleados.edit', compact('empleado', 'roles'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rut' => 'required|string|max:20|unique:empleados,rut,' . $empleado->id,
            'dig_verificador' => 'required|string|size:1',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            $empleado->update([
                'nombre' => $request->nombre,
                'rut' => str_replace(['.', '-'], '', $request->rut),
                'dig_verificador' => strtoupper($request->dig_verificador),
                'role_id' => $request->role_id,
            ]);

            return redirect()->route('empleados.index')
                           ->with('success', 'Empleado actualizado exitosamente.');
                           
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['error' => 'Error al actualizar empleado: ' . $e->getMessage()])
                           ->withInput();
        }
    }

    public function destroy(Empleado $empleado)
    {
        try {
            DB::transaction(function () use ($empleado) {
                // Eliminar usuario asociado si existe
                if ($empleado->user) {
                    $empleado->user->delete();
                }
                
                // Eliminar empleado (esto también eliminará sueldos y movimientos por cascade)
                $empleado->delete();
            });

            return redirect()->route('empleados.index')
                           ->with('success', 'Empleado eliminado exitosamente.');
                           
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['error' => 'Error al eliminar empleado: ' . $e->getMessage()]);
        }
    }
}