<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaGasto extends Model
{
    use HasFactory;

    protected $table = 'categorias_gastos';

    protected $fillable = [
        'nombre',
        'icono',
        'color',
        'es_predefinida',
    ];

    protected $casts = [
        'es_predefinida' => 'boolean',
    ];

    // Relación: Una categoría tiene muchos gastos
    public function gastos()
    {
        return $this->hasMany(GastoPersonal::class, 'categoria_id');
    }

    // Scope: Solo categorías predefinidas
    public function scopePredefinidas($query)
    {
        return $query->where('es_predefinida', true);
    }

    // Scope: Solo categorías personalizadas
    public function scopePersonalizadas($query)
    {
        return $query->where('es_predefinida', false);
    }
}