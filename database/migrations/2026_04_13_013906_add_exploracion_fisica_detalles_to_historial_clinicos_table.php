<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Signos Vitales
            $table->string('ta_derecho')->nullable();
            $table->string('ta_izquierdo')->nullable();
            $table->string('fc')->nullable(); // Frecuencia Cardíaca
            $table->string('sat')->nullable(); // Saturación de Oxígeno
            $table->string('fr')->nullable(); // Frecuencia Respiratoria
            $table->string('glagow')->nullable(); // Escala de Glasgow
            $table->string('glicemia')->nullable();
            $table->string('hb')->nullable(); // Hemoglobina
            
            // Exploración Física por regiones
            $table->text('cabeza')->nullable();
            $table->text('cuello')->nullable();
            $table->text('torax')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('extremidades')->nullable();
            $table->text('neurologico')->nullable();
            $table->text('estado_mental')->nullable();
            
            // Estudios
            $table->text('laboratorio')->nullable();
            $table->text('estudio_imagen')->nullable();
            $table->text('otros_exploracion')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->dropColumn([
                'ta_derecho', 'ta_izquierdo', 'fc', 'sat', 'fr', 'glagow', 'glicemia', 'hb',
                'cabeza', 'cuello', 'torax', 'abdomen', 'extremidades', 'neurologico', 'estado_mental',
                'laboratorio', 'estudio_imagen', 'otros_exploracion'
            ]);
        });
    }
};