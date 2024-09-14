<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaAcademico extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_snies',
        'nombre_programa',
        'descripcion',
        'logo',
        'correo',
        'fecha_resolucion',
        'numero_resolucion',
        'archivo_resolucion',
    ];

    // Si quieres convertir la fecha en un formato legible, puedes usar la siguiente propiedad
    protected $dates = ['fecha_resolucion'];
}
