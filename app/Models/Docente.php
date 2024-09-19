<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Docente extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'nombre',
        'identificacion',
        'direccion',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'formacion_academica',
        'area_conocimiento',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
    ];

}
