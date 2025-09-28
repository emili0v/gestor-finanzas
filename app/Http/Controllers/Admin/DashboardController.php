<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Movimiento;
use App\Models\Sueldo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now();
        $inicioMes = $mesActual->copy()->startOfMonth();
        $finMes = $mesActual->copy()->endOfMonth();

        // 1. Métricas principales
        $totalEmpleados = Empleado::count();
        $empleadosActivos = Empleado::count();
        
        // 2. Cálculos de nómina (convertir centavos a pesos)
        $totalSueldosBrutos = Sueldo::sum('monto_bruto');
        
        // 3. Movimientos del mes actual (bonos y descuentos) - CORREGIDO
        $bonosDelMes = Movimiento::whereBetween('fecha', [$inicioMes, $finMes])
                                ->where('monto', '>', 0)
                                ->sum('monto') / 100; // Convertir centavos a pesos
                                
        $descuentosDelMes = Movimiento::whereBetween('fecha', [$inicioMes, $finMes])
                                     ->where('monto', '<', 0)
                                     ->sum('monto') / 100; // Convertir centavos a pesos

        // 4. Cálculo del costo total de nómina del mes
        $costoNominaDelMes = $totalSueldosBrutos + $bonosDelMes + $descuentosDelMes;
        
        // 5. Balance general (ingresos - egresos)
        $balanceGeneral = $bonosDelMes + $descuentosDelMes;
        
        // 6. Últimos movimientos (últimos 10)
        $ultimosMovimientos = Movimiento::with(['empleado', 'categoria'])
                                       ->orderBy('fecha', 'desc')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(10)
                                       ->get();
        
        // 7. Últimos empleados creados (últimos 5)
        $ultimosEmpleados = Empleado::with('role')
                                   ->orderBy('created_at', 'desc')
                                   ->limit(5)
                                   ->get();

        // 8. Datos para gráficos (empleados por rol)
        $empleadosPorRol = Empleado::with('role')
                                  ->get()
                                  ->groupBy('role.nombre')
                                  ->map(function ($grupo) {
                                      return $grupo->count();
                                  });

        return view('dashboard', compact(
            'totalEmpleados',
            'empleadosActivos',
            'totalSueldosBrutos',
            'bonosDelMes',
            'descuentosDelMes',
            'costoNominaDelMes',
            'balanceGeneral',
            'ultimosMovimientos',
            'ultimosEmpleados',
            'empleadosPorRol',
            'mesActual'
        ));
    }
}