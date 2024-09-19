<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinadoresTable extends Migration
{
    public function up()
    {
        Schema::create('coordinadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo')->unique();
            $table->string('identificacion')->unique();
            $table->string('telefono');
            $table->string('direccion')->nullable();
            $table->foreignId('programa_academico_id')->constrained()->onDelete('cascade'); // Agregar este campo
            $table->string('genero');
            $table->date('fecha_nacimiento');
            $table->date('fecha_vinculacion');
            $table->string('acuerdo_vinculacion');
            $table->string('password');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('coordinadores');
    }
}
