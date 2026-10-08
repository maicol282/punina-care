<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Antecedentes Personales Patológicos
            $table->text('hospitalizaciones')->nullable();
            $table->text('cardiovasculares')->nullable();
            $table->text('pulmonales')->nullable();
            $table->text('digestivos')->nullable();
            $table->text('diabetes')->nullable();
            $table->text('renales')->nullable();
            $table->text('quirurgicos')->nullable();
            $table->text('transfusiones')->nullable();
            $table->text('alergias_patologicas')->nullable();
            $table->text('otros_patologicos')->nullable();
            
            // Antecedentes Personales No Patológicos
            $table->text('alcohol')->nullable();
            $table->text('tabaquismo')->nullable();
            $table->text('drogas')->nullable();
            $table->text('inmunizaciones')->nullable();
            $table->text('otros_no_patologicos')->nullable();
            
            // Antecedentes Personales
            $table->text('antecedentes_personales')->nullable();
            
            // Antecedentes Gineco Obstétricos
            $table->text('menarquia')->nullable();
            $table->text('ritmo')->nullable();
            $table->text('fmu')->nullable();
            $table->text('gestas')->nullable();
            $table->text('partos')->nullable();
            $table->text('abortos')->nullable();
            $table->text('cesareas')->nullable();
            $table->text('num_parejas_sexuales')->nullable();
            
            // Métodos Anticonceptivos
            $table->boolean('usa_anticonceptivos')->default(false);
            $table->text('cuales_anticonceptivos')->nullable();
            
            // Enfermedad Actual
            $table->text('enfermedad_actual')->nullable();
            
            // Exploración Física
            $table->text('exploracion_fisica')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->dropColumn([
                'hospitalizaciones',
                'cardiovasculares',
                'pulmonales',
                'digestivos',
                'diabetes',
                'renales',
                'quirurgicos',
                'transfusiones',
                'alergias_patologicas',
                'otros_patologicos',
                'alcohol',
                'tabaquismo',
                'drogas',
                'inmunizaciones',
                'otros_no_patologicos',
                'antecedentes_personales',
                'menarquia',
                'ritmo',
                'fmu',
                'gestas',
                'partos',
                'abortos',
                'cesareas',
                'num_parejas_sexuales',
                'usa_anticonceptivos',
                'cuales_anticonceptivos',
                'enfermedad_actual',
                'exploracion_fisica'
            ]);
        });
    }
};