<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'empleado_id',
        'role', // ✅ Agregado al fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    // ✅ Métodos helper actualizados para sistema unificado
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEmpleado()
    {
        return $this->role === 'user';
    }
}