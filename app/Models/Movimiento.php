<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = ['empleado_id', 'categoria_id', 'fecha', 'descripcion', 'monto'];

    // Un movimiento pertenece a un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    // Un movimiento pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // NUEVO: Convierte centavos a pesos al mostrar (leer desde BD)
    public function getMontoAttribute($value)
    {
        return $value / 100;
    }

    // NUEVO: Convierte pesos a centavos al guardar (escribir a BD)
    public function setMontoAttribute($value)
    {
        $this->attributes['monto'] = $value * 100;
    }

    // NUEVO: Método helper para verificar si es un bono (monto positivo)
    public function esBono()
    {
        return $this->monto > 0;
    }

    // NUEVO: Método helper para verificar si es un descuento (monto negativo)
    public function esDescuento()
    {
        return $this->monto < 0;
    }

    // NUEVO: Scope para filtrar solo bonos
    public function scopeBonos($query)
    {
        return $query->where('monto', '>', 0);
    }

    // NUEVO: Scope para filtrar solo descuentos
    public function scopeDescuentos($query)
    {
        return $query->where('monto', '<', 0);
    }
}