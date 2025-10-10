<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GastoPersonal;
use App\Models\CategoriaGasto;
use App\Models\PerfilUsuario;
use App\Models\ResumenGastoMensual;
use App\Models\AlertaGasto;
use App\Models\ConfiguracionAlerta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GastoPersonalController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado) {
            return redirect()->route('app.mi-sueldo')->with('error', 'No tienes un perfil de empleado asociado.');
        }

        // Obtener o crear perfil de usuario
        $perfil = PerfilUsuario::firstOrCreate(
            ['empleado_id' => $empleado->id],
            []
        );

        // Crear configuración de alertas si no existe
        ConfiguracionAlerta::firstOrCreate(
            ['perfil_usuario_id' => $perfil->id],
            [
                'umbral_informacion' => 50,
                'umbral_advertencia' => 70,
                'umbral_critico' => 90,
            ]
        );

        // Obtener mes actual
        $mesActual = now()->format('Y-m');
        
        // Obtener gastos del mes actual
        $gastos = GastoPersonal::where('perfil_usuario_id', $perfil->id)
            ->where('mes_referencia', $mesActual)
            ->with('categoria')
            ->orderBy('fecha', 'desc')
            ->get();

        // Obtener categorías
        $categorias = CategoriaGasto::orderBy('nombre')->get();

        // Calcular sueldo líquido del mes actual
        $sueldoBruto = $empleado->sueldos()->latest()->first()->monto_bruto ?? 0;
        
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        
        $totalBonos = $empleado->movimientos()
            ->whereBetween('fecha', [$inicioMes, $finMes])
            ->where('monto', '>', 0)
            ->sum('monto');
            
        $totalDescuentos = abs($empleado->movimientos()
            ->whereBetween('fecha', [$inicioMes, $finMes])
            ->where('monto', '<', 0)
            ->sum('monto'));
            
        $sueldoLiquido = $sueldoBruto + $totalBonos - $totalDescuentos;

        // Calcular resumen y verificar alertas
        $resumen = ResumenGastoMensual::calcularResumen($perfil->id, $mesActual, $sueldoLiquido);
        $this->verificarYGenerarAlertas($perfil, $mesActual, $resumen);

        // Obtener alertas no leídas
        $alertasNoLeidas = $perfil->alertasNoLeidas();

        return view('app.gastos', compact(
            'gastos',
            'categorias',
            'empleado',
            'perfil',
            'resumen',
            'alertasNoLeidas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias_gastos,id',
            'monto' => 'required|numeric|min:1',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado) {
            return redirect()->back()->with('error', 'No tienes un perfil de empleado asociado.');
        }

        $perfil = PerfilUsuario::firstOrCreate(['empleado_id' => $empleado->id]);

        GastoPersonal::create([
            'perfil_usuario_id' => $perfil->id,
            'categoria_id' => $request->categoria_id,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'mes_referencia' => Carbon::parse($request->fecha)->format('Y-m'),
        ]);

        return redirect()->route('app.gastos')->with('success', 'Gasto registrado exitosamente');
    }

    public function destroy(GastoPersonal $gasto)
    {
        $gasto->delete();
        return redirect()->route('app.gastos')->with('success', 'Gasto eliminado exitosamente');
    }

    private function verificarYGenerarAlertas($perfil, $periodo, $resumen)
    {
        $configuracion = $perfil->configuracionAlertas;
        
        if (!$configuracion || !$configuracion->notificar_en_sistema) {
            return;
        }

        $porcentaje = $resumen->porcentaje_gastado;
        $alertaInfo = $configuracion->obtenerNivelAlerta($porcentaje);

        if ($alertaInfo) {
            // Verificar si ya existe una alerta para este umbral en este período
            $alertaExistente = AlertaGasto::where('perfil_usuario_id', $perfil->id)
                ->where('periodo', $periodo)
                ->where('umbral_alcanzado', $alertaInfo['umbral'])
                ->first();

            if (!$alertaExistente) {
                AlertaGasto::create([
                    'perfil_usuario_id' => $perfil->id,
                    'periodo' => $periodo,
                    'umbral_alcanzado' => $alertaInfo['umbral'],
                    'nivel' => $alertaInfo['nivel'],
                    'porcentaje_actual' => $porcentaje,
                    'saldo_restante' => $resumen->saldo_disponible,
                    'mensaje' => AlertaGasto::generarMensaje(
                        $alertaInfo['nivel'],
                        round($porcentaje, 1),
                        $resumen->saldo_disponible
                    ),
                ]);
            }
        }
    }
}