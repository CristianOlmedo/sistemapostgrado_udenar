<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohorte extends Model
{
    use HasFactory;

    protected $table = 'cohortes';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo',
        'nombre',
        'programa_id',
        'fecha_inicio',
        'fecha_fin',
        'numero_estudiantes_matriculados',
    ];

    // Relación con ProgramaAcademico (Un cohorte pertenece a un programa académico)
    public function programa()
    {
        return $this->belongsTo(ProgramaAcademico::class, 'programa_id');
    }
}
