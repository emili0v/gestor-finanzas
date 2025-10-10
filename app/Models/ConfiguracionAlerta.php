<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionAlerta extends Model
{
    use HasFactory;

    protected $table = 'configuracion_alertas';

    protected $fillable = [
        'perfil_usuario_id',
        'umbral_informacion',
        'umbral_advertencia',
        'umbral_critico',
        'notificar_en_sistema',
    ];

    protected $casts = [
        'notificar_en_sistema' => 'boolean',
    ];

    // Relación: Una configuración pertenece a un perfil
    public function perfilUsuario()
    {
        return $this->belongsTo(PerfilUsuario::class);
    }

    // Método helper: Obtener nivel de alerta según porcentaje
    public function obtenerNivelAlerta($porcentaje)
    {
        if ($porcentaje >= $this->umbral_critico) {
            return ['nivel' => 'critico', 'umbral' => '90'];
        } elseif ($porcentaje >= $this->umbral_advertencia) {
            return ['nivel' => 'advertencia', 'umbral' => '70'];
        } elseif ($porcentaje >= $this->umbral_informacion) {
            return ['nivel' => 'informacion', 'umbral' => '50'];
        }
        
        return null;
    }
}