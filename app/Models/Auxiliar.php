<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Auxiliar extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'nombre',
        'identificacion',
        'programa_academico_id',
        'direccion',
        'telefono',
        'email',
        'genero',
        'fecha_nacimiento',
        'fecha_vinculacion',
        'acuerdo_vinculacion',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación con Programa Académico
    public function programaAcademico() {
        return $this->belongsTo(ProgramaAcademico::class);
    }
}
