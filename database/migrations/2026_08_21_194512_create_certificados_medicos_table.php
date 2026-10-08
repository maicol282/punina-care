<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certificados_medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->constrained()->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            
            // Datos del paciente (se copian para mantener historial)
            $table->string('paciente_nombre');
            $table->string('paciente_cedula');
            $table->string('paciente_direccion')->nullable();
            $table->string('paciente_telefono')->nullable();
            $table->string('paciente_empresa')->nullable();
            $table->string('paciente_puesto')->nullable();
            
            // Datos del certificado
            $table->date('fecha_atencion');
            $table->text('diagnosticos')->nullable();
            $table->string('tipo_contingencia')->default('enfermedad_general');
            $table->boolean('reposo')->default(false);
            $table->date('reposo_inicio')->nullable();
            $table->date('reposo_fin')->nullable();
            $table->integer('reposo_dias')->nullable();
            $table->text('observaciones')->nullable();
            
            // Médico que emite
            $table->string('medico_nombre');
            $table->string('medico_cedula')->nullable();
            $table->string('medico_especialidad')->nullable();
            
            // Estado
            $table->enum('estado', ['activo', 'anulado'])->default('activo');
            
            $table->timestamps();
            
            $table->index('paciente_id');
            $table->index('fecha_atencion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificados_medicos');
    }
};