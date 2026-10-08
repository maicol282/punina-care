<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Antecedentes Patológicos
            $table->text('hospitalizaciones')->nullable()->change();
            $table->text('cardiovasculares')->nullable()->change();
            $table->text('pulmonales')->nullable()->change();
            $table->text('digestivos')->nullable()->change();
            $table->text('diabetes')->nullable()->change();
            $table->text('renales')->nullable()->change();
            $table->text('quirurgicos')->nullable()->change();
            $table->text('transfusiones')->nullable()->change();
            $table->text('alergias_patologicas')->nullable()->change();
            $table->text('otros_patologicos')->nullable()->change();
            
            // Antecedentes No Patológicos
            $table->text('alcohol')->nullable()->change();
            $table->text('tabaquismo')->nullable()->change();
            $table->text('drogas')->nullable()->change();
            $table->text('inmunizaciones')->nullable()->change();
            $table->text('antecedentes_familiares')->nullable()->change();
            $table->text('otros_no_patologicos')->nullable()->change();
            
            // Antecedentes Personales
            $table->text('antecedentes_personales')->nullable()->change();
            
            // Gineco Obstétricos
            $table->string('menarquia')->nullable()->change();
            $table->string('ritmo')->nullable()->change();
            $table->string('fmu')->nullable()->change();
            $table->string('gestas')->nullable()->change();
            $table->string('partos')->nullable()->change();
            $table->string('abortos')->nullable()->change();
            $table->string('cesareas')->nullable()->change();
            $table->string('num_parejas_sexuales')->nullable()->change();
            $table->string('menopausia')->nullable()->change();
            
            // Métodos Anticonceptivos
            $table->text('cuales_anticonceptivos')->nullable()->change();
            
            // Signos Vitales
            $table->string('presion_arterial')->nullable()->change();
            $table->string('ta_derecho')->nullable()->change();
            $table->string('ta_izquierdo')->nullable()->change();
            $table->string('fc')->nullable()->change();
            $table->string('sat')->nullable()->change();
            $table->string('fr')->nullable()->change();
            $table->decimal('temperatura', 4, 2)->nullable()->change();
            $table->string('glagow')->nullable()->change();
            $table->decimal('peso', 5, 2)->nullable()->change();
            $table->decimal('altura', 3, 2)->nullable()->change();
            $table->string('glicemia')->nullable()->change();
            $table->string('hb')->nullable()->change();
            
            // Exploración por Regiones
            $table->text('cabeza')->nullable()->change();
            $table->text('cuello')->nullable()->change();
            $table->text('torax')->nullable()->change();
            $table->text('abdomen')->nullable()->change();
            $table->text('extremidades')->nullable()->change();
            $table->text('neurologico')->nullable()->change();
            $table->text('estado_mental')->nullable()->change();
            
            // Estudios
            $table->text('laboratorio')->nullable()->change();
            $table->text('estudio_imagen')->nullable()->change();
            $table->text('otros_exploracion')->nullable()->change();
            
            // Enfermedad Actual y Observaciones
            $table->text('enfermedad_actual')->nullable()->change();
            $table->text('exploracion_fisica')->nullable()->change();
            $table->text('observaciones')->nullable()->change();
        });
    }

    public function down(): void
    {
        // No es necesario revertir
    }
};
