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
        Schema::create('programa_academicos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_snies')->unique();
            $table->string('nombre_programa')->unique();
            $table->string('descripcion');
            $table->text('logo');
            $table->string('correo')->unique();
            $table->date('fecha_resolucion');
            $table->string('numero_resolucion');
            $table->string('archivo_resolucion'); 

            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('programa_academicos');
    }
};
