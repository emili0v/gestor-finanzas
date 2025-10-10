<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'rut', 'dig_verificador', 'role_id'];

    //Para que siempre aparezca en JSON
    protected $appends = ['rut_completo'];


    // Relación con rol
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación con sueldos (corregida)
    public function sueldos()
    {
        return $this->hasMany(Sueldo::class);
    }

    // Relación con movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Relación con usuario
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Accessor para obtener el RUT completo
    public function getRutCompletoAttribute()
    {
        if (!$this->rut || !$this->dig_verificador) {
            return null;
        }

        $rut = number_format($this->rut, 0, ',', '.'); 
        return "{$rut}-{$this->dig_verificador}";
    }
       
    // Relación: Un empleado tiene un perfil de usuario
    public function perfilUsuario()
    {
        return $this->hasOne(PerfilUsuario::class);
    }
}