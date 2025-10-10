<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AlertaGasto;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function marcarLeida(AlertaGasto $alerta)
    {
        $alerta->marcarComoLeida();
        
        return response()->json([
            'success' => true,
            'message' => 'Alerta marcada como leída',
        ]);
    }

    public function marcarTodasLeidas(Request $request)
    {
        $user = $request->user();
        $empleado = $user->empleado;
        
        if (!$empleado || !$empleado->perfilUsuario) {
            return response()->json(['success' => false], 404);
        }

        AlertaGasto::where('perfil_usuario_id', $empleado->perfilUsuario->id)
            ->where('leida', false)
            ->update([
                'leida' => true,
                'fecha_lectura' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Todas las alertas marcadas como leídas',
        ]);
    }
}