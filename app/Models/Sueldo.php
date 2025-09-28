<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldo extends Model
{
    use HasFactory;

    protected $fillable = ['empleado_id', 'monto_bruto'];

    // Un sueldo pertenece a un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}