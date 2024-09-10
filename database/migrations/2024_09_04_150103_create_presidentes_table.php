<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('presidentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('correo_electronico')->unique();
            $table->string('numero_identificacion')->unique();
            $table->string('telefono');
            $table->text('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_inicio_gestion');
            $table->date('fecha_fin_gestion')->nullable();
            $table->string('departamento_o_facultad');
            $table->string('programa_academico');
            $table->boolean('estado')->default(true);
            $table->text('resoluciones_o_nombramientos')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presidentes');
    }
};
