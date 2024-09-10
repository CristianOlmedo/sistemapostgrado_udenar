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
        Schema::create('linea_trabajo_programa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programa_academico_id')->constrained('programa_academicos')->onDelete('cascade');
            $table->foreignId('linea_trabajo_id')->constrained('lineas_trabajo')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linea_trabajo_programas');
    }
};
