<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reposos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->constrained()->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('dias')->nullable();
            $table->string('tipo')->default('laboral');
            $table->text('diagnostico');
            $table->text('recomendaciones')->nullable();
            $table->string('medico_emisor');
            $table->string('numero_reposo')->unique();
            $table->enum('estado', ['activo', 'completado', 'anulado'])->default('activo');
            $table->timestamps();
            
            $table->index('fecha_inicio');
            $table->index('fecha_fin');
            $table->index('estado');
            $table->index('paciente_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reposos');
    }
};