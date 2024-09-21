<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class Coordinador extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'coordinadores'; // Indica el nombre de la tabla

    // Definir los campos de fechas
    protected $dates = ['fecha_nacimiento', 'fecha_vinculacion'];

    // Campos asignables en masa
    protected $fillable = [
        'nombre',
        'identificacion',
        'programa_academico_id',
        'direccion',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'fecha_vinculacion',
        'acuerdo_vinculacion',
    ];

    // Ocultar los campos sensibles
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts para formatos de campos
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
        'fecha_vinculacion' => 'date',
    ];

    // Relación con Programa Académico
    public function programaAcademico()
    {
        return $this->belongsTo(ProgramaAcademico::class);
    }

    // Mutador para encriptar la contraseña automáticamente
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
