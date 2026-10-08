<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estudios_adjuntos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->constrained()->onDelete('cascade');
            $table->string('nombre_original');
            $table->string('nombre_guardado');
            $table->string('ruta');
            $table->string('tipo_archivo'); // imagen, pdf, documento
            $table->string('mime_type');
            $table->integer('tamano');
            $table->text('descripcion')->nullable();
            $table->string('categoria')->default('estudio'); // estudio, receta, etc
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudios_adjuntos');
    }
};