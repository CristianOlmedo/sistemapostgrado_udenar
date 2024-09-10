<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Presidente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre_completo',
        'correo_electronico',
        'numero_identificacion',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'fecha_inicio_gestion',
        'fecha_fin_gestion',
        'departamento_o_facultad',
        'programa_academico',
        'estado',
        'resoluciones_o_nombramientos',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_inicio_gestion' => 'date',
        'fecha_fin_gestion' => 'date',
    ];
}
