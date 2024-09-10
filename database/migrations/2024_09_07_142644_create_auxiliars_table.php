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
        Schema::create('auxiliars', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion');
            $table->foreignId('programa_academico_id')->constrained();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->date('fecha_nacimiento');
            $table->date('fecha_vinculacion');
            $table->string('acuerdo_vinculacion')->nullable(); // archivo PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auxiliars');
    }
};
