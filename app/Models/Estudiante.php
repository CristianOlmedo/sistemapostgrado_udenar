<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Estudiante extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'nombre',
        'cohorte_id',
        'identificacion',
        'direccion',
        'codigo_estudiantil',
        'foto',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'semestre',
        'fecha_ingreso',
        'fecha_egreso',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
    ];

    // Relación con Programa Académico
    public function cohorte() {
        return $this->belongsTo(Cohorte::class, 'cohorte_id');
    }

}
