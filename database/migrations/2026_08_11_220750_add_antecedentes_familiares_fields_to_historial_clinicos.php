<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Campo para antecedentes familiares (observaciones)
            if (!Schema::hasColumn('historial_clinicos', 'antecedentes_familiares')) {
                $table->text('antecedentes_familiares')->nullable()->after('otros_no_patologicos');
            }
            
            // Campos para enfermedades familiares (checkbox)
            $enfermedades = [
                'familiar_hipertension',
                'familiar_diabetes',
                'familiar_cardiopatias',
                'familiar_cancer',
                'familiar_obesidad',
                'familiar_dislipidemia',
                'familiar_enfermedad_renal',
                'familiar_enfermedad_tiroidea',
                'familiar_enfermedad_mental',
                'familiar_tuberculosis',
                'familiar_alcoholismo',
                'familiar_otras'
            ];
            
            foreach ($enfermedades as $enfermedad) {
                if (!Schema::hasColumn('historial_clinicos', $enfermedad)) {
                    $table->boolean($enfermedad)->default(false)->nullable();
                }
            }
            
            // Campo "no refiere"
            if (!Schema::hasColumn('historial_clinicos', 'familiares_no_refiere')) {
                $table->boolean('familiares_no_refiere')->default(false)->nullable()->after('antecedentes_familiares');
            }
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $enfermedades = [
                'familiar_hipertension',
                'familiar_diabetes',
                'familiar_cardiopatias',
                'familiar_cancer',
                'familiar_obesidad',
                'familiar_dislipidemia',
                'familiar_enfermedad_renal',
                'familiar_enfermedad_tiroidea',
                'familiar_enfermedad_mental',
                'familiar_tuberculosis',
                'familiar_alcoholismo',
                'familiar_otras'
            ];
            
            foreach ($enfermedades as $enfermedad) {
                if (Schema::hasColumn('historial_clinicos', $enfermedad)) {
                    $table->dropColumn($enfermedad);
                }
            }
            
            if (Schema::hasColumn('historial_clinicos', 'familiares_no_refiere')) {
                $table->dropColumn('familiares_no_refiere');
            }
            
            if (Schema::hasColumn('historial_clinicos', 'antecedentes_familiares')) {
                $table->dropColumn('antecedentes_familiares');
            }
        });
    }
};