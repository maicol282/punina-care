<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Nuevos campos de exploración física
            $campos = [
                'piel', 'columna', 'pelvis', 'axilas', 'mamas'
            ];
            
            foreach ($campos as $campo) {
                if (!Schema::hasColumn('historial_clinicos', $campo)) {
                    $table->text($campo)->nullable()->after('estado_mental');
                }
                
                // Campo tipo (CP/SP) para cada uno
                $tipoCampo = $campo . '_tipo';
                if (!Schema::hasColumn('historial_clinicos', $tipoCampo)) {
                    $table->enum($tipoCampo, ['CP', 'SP'])->default('SP')->after($campo);
                }
            }
            
            // Campos tipo para los existentes (cabeza, cuello, torax, abdomen, extremidades, neurologico)
            $existentes = ['cabeza', 'cuello', 'torax', 'abdomen', 'extremidades', 'neurologico'];
            foreach ($existentes as $campo) {
                $tipoCampo = $campo . '_tipo';
                if (!Schema::hasColumn('historial_clinicos', $tipoCampo)) {
                    $table->enum($tipoCampo, ['CP', 'SP'])->default('SP')->after($campo);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $campos = ['piel', 'columna', 'pelvis', 'axilas', 'mamas'];
            $existentes = ['cabeza', 'cuello', 'torax', 'abdomen', 'extremidades', 'neurologico'];
            $todos = array_merge($campos, $existentes);
            
            foreach ($todos as $campo) {
                if (Schema::hasColumn('historial_clinicos', $campo)) {
                    $table->dropColumn($campo);
                }
                $tipoCampo = $campo . '_tipo';
                if (Schema::hasColumn('historial_clinicos', $tipoCampo)) {
                    $table->dropColumn($tipoCampo);
                }
            }
        });
    }
};