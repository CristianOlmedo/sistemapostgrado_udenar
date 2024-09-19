<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cohorte_id')->constrained();
            $table->string('nombre');
            $table->string('identificacion')->unique();
            $table->string('codigo_estudiantil')->unique();
            $table->text('foto')->nullable();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->date('fecha_nacimiento');
            $table->unsignedInteger('semestre');
            $table->date('fecha_ingreso');
            $table->date('fecha_egreso')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
