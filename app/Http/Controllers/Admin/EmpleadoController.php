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
use Illuminate\Validation\Rule;

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
            $sueldoBruto = $sueldoReciente->monto_bruto ?? 0;
            
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
        // ✅ VALIDACIÓN MEJORADA: Incluye unicidad de RUT y email
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rut' => [
                'required',
                'string',
                'max:20',
                Rule::unique('empleados', 'rut')
            ],
            'dig_verificador' => 'required|string|size:1',
            'role_id' => 'required|exists:roles,id',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'password' => 'required|string|min:8',
            'sueldo_bruto' => 'required|numeric|min:0',
        ], [
            'rut.unique' => 'Ya existe un empleado con este RUT.',
            'email.unique' => 'Ya existe un usuario con este correo electrónico.',
            'role_id.exists' => 'El cargo seleccionado no es válido.',
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
                    'role' => 'user', // Todos los nuevos empleados tienen rol 'user' en el sistema
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
        // ✅ VALIDACIÓN: Permitir el mismo RUT del empleado actual
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rut' => [
                'required',
                'string',
                'max:20',
                Rule::unique('empleados', 'rut')->ignore($empleado->id)
            ],
            'dig_verificador' => 'required|string|size:1',
            'role_id' => 'required|exists:roles,id',
        ], [
            'rut.unique' => 'Ya existe otro empleado con este RUT.',
            'role_id.exists' => 'El cargo seleccionado no es válido.',
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