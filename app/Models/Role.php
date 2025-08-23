<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Un rol puede tener muchos usuarios/empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
