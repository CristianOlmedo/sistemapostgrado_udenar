<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinadorsTable extends Migration
{
    public function up()
    {
        Schema::create('coordinadors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion')->unique();
            $table->unsignedBigInteger('programa_academico_id');
            $table->string('direccion')->nullable();
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->string('genero')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_vinculacion');
            $table->string('acuerdo_vinculacion')->nullable();
            $table->string('password');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('programa_academico_id')->references('id')->on('programa_academicos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('coordinadors');
    }
}
