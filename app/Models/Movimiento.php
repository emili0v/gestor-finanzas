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
}
