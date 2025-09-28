<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // CORRECCIÓN: Agregar 'tipo' al fillable para evitar errores de mass assignment
    protected $fillable = ['nombre', 'tipo'];

    // Valor por defecto para el campo tipo (importante para bonos)
    protected $attributes = [
        'tipo' => 'ingreso' // Valor por defecto para categorías de bonos
    ];

    // Una categoria puede tener muchos movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Scope para filtrar por tipo de categoría
    public function scopeIngresos($query)
    {
        return $query->where('tipo', 'ingreso');
    }

    public function scopeEgresos($query)
    {
        return $query->where('tipo', 'egreso');
    }

    // Método para verificar si es una categoría de ingreso
    public function esIngreso()
    {
        return $this->tipo === 'ingreso';
    }

    // Método para verificar si es una categoría de egreso
    public function esEgreso()
    {
        return $this->tipo === 'egreso';
    }
}