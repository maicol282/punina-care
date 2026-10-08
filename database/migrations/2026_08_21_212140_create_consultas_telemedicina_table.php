<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultas_telemedicina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('historial_clinico_id')->nullable()->constrained()->onDelete('set null');
            
            $table->dateTime('fecha_hora_programada');
            $table->integer('duracion')->default(30);
            $table->string('sala_nombre')->unique();
            
            $table->enum('estado', ['programada', 'en_curso', 'completada', 'cancelada'])->default('programada');
            
            $table->text('motivo')->nullable();
            $table->text('notas')->nullable();
            $table->dateTime('fecha_inicio_real')->nullable();
            $table->dateTime('fecha_fin_real')->nullable();
            
            $table->timestamps();
            
            $table->index('fecha_hora_programada');
            $table->index('estado');
            $table->index(['paciente_id', 'fecha_hora_programada']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultas_telemedicina');
    }
};