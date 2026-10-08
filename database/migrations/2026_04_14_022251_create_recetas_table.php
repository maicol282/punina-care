<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->constrained()->onDelete('cascade');
            $table->date('fecha_emision');
            $table->string('medicamento');
            $table->string('presentacion')->nullable();
            $table->string('concentracion')->nullable();
            $table->string('dosis');
            $table->string('frecuencia');
            $table->string('duracion');
            $table->text('indicaciones')->nullable();
            $table->text('advertencias')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};