<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Antecedentes Patológicos
            $table->text('hospitalizaciones')->default('Ninguna')->change();
            $table->text('cardiovasculares')->default('Ninguna')->change();
            $table->text('pulmonales')->default('Ninguna')->change();
            $table->text('digestivos')->default('Ninguna')->change();
            $table->text('diabetes')->default('Ninguna')->change();
            $table->text('renales')->default('Ninguna')->change();
            $table->text('quirurgicos')->default('Ninguna')->change();
            $table->text('transfusiones')->default('Ninguna')->change();
            $table->text('alergias_patologicas')->default('Ninguna')->change();
            $table->text('otros_patologicos')->default('Ninguno')->change();
            
            // Antecedentes No Patológicos
            $table->text('alcohol')->default('No consume')->change();
            $table->text('tabaquismo')->default('No fuma')->change();
            $table->text('drogas')->default('No consume')->change();
            $table->text('inmunizaciones')->default('Esquema completo')->change();
            $table->text('antecedentes_familiares')->default('No refiere')->change();
            $table->text('otros_no_patologicos')->default('Ninguno')->change();
            
            // Antecedentes Personales
            $table->text('antecedentes_personales')->default('No refiere antecedentes')->change();
            
            // Gineco Obstétricos
            $table->string('menarquia')->default('No aplica')->change();
            $table->string('ritmo')->default('No aplica')->change();
            $table->string('fmu')->default('No aplica')->change();
            $table->string('gestas')->default('0')->change();
            $table->string('partos')->default('0')->change();
            $table->string('abortos')->default('0')->change();
            $table->string('cesareas')->default('0')->change();
            $table->string('num_parejas_sexuales')->default('No aplica')->change();
            $table->string('menopausia')->default('No aplica')->change();
            
            // Métodos Anticonceptivos
            $table->boolean('usa_anticonceptivos')->default(false)->change();
            $table->text('cuales_anticonceptivos')->default('Ninguno')->change();
            
            // Signos Vitales
            $table->string('presion_arterial')->default('No registrada')->change();
            $table->string('ta_derecho')->default('No registrada')->change();
            $table->string('ta_izquierdo')->default('No registrada')->change();
            $table->string('fc')->default('No registrada')->change();
            $table->string('sat')->default('No registrada')->change();
            $table->string('fr')->default('No registrada')->change();
            $table->decimal('temperatura', 4, 2)->default(36.5)->change();
            $table->string('glagow')->default('15/15')->change();
            $table->decimal('peso', 5, 2)->default(70.00)->change();
            $table->decimal('altura', 3, 2)->default(1.65)->change();
            $table->string('glicemia')->default('No registrada')->change();
            $table->string('hb')->default('No registrada')->change();
            
            // Exploración por Regiones
            $table->text('cabeza')->default('Sin hallazgos patológicos')->change();
            $table->text('cuello')->default('Sin hallazgos patológicos')->change();
            $table->text('torax')->default('Sin hallazgos patológicos')->change();
            $table->text('abdomen')->default('Sin hallazgos patológicos')->change();
            $table->text('extremidades')->default('Sin hallazgos patológicos')->change();
            $table->text('neurologico')->default('Sin hallazgos patológicos')->change();
            $table->text('estado_mental')->default('Orientado en tiempo, espacio y persona')->change();
            
            // Estudios
            $table->text('laboratorio')->default('Pendiente')->change();
            $table->text('estudio_imagen')->default('Pendiente')->change();
            $table->text('otros_exploracion')->default('Ninguno')->change();
            
            // Enfermedad Actual y Exploración Física
            $table->text('enfermedad_actual')->default('Paciente refiere no presentar síntomas en el momento')->change();
            $table->text('exploracion_fisica')->default('Paciente en buenas condiciones generales')->change();
            
            // Observaciones
            $table->text('observaciones')->default('Sin observaciones adicionales')->change();
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // No es necesario revertir los defaults
        });
    }
};