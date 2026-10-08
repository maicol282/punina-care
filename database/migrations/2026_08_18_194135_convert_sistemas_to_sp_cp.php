<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Primero, agregar columnas temporales y luego convertir los datos
        $sistemas = [
            'sist_cardiovascular' => 'sist_cardiovascular',
            'sist_respiratorio' => 'sist_respiratorio',
            'sist_digestivo' => 'sist_digestivo',
            'sist_renal' => 'sist_renal',
            'sist_neurologico' => 'sist_neurologico',
            'sist_musculoesqueletico' => 'sist_musculoesqueletico',
            'sist_endocrino' => 'sist_endocrino',
            'sist_hematologico' => 'sist_hematologico',
            'sist_linfatico' => 'sist_linfatico',
            'sist_genitourinario' => 'sist_genitourinario',
            'sist_piel' => 'sist_piel',
            'sist_oftalmologico' => 'sist_oftalmologico',
            'sist_orl' => 'sist_orl',
            'sist_psiquiatrico' => 'sist_psiquiatrico'
        ];

        foreach ($sistemas as $campo => $valor) {
            // 1. Crear una columna temporal
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->string($campo . '_temp')->nullable();
            });

            // 2. Copiar datos convirtiendo booleanos a SP/CP
            DB::statement("UPDATE historial_clinicos SET {$campo}_temp = CASE WHEN {$campo} = 1 THEN 'CP' ELSE 'SP' END");

            // 3. Eliminar columna original
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->dropColumn($campo);
            });

            // 4. Crear columna original como ENUM
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->enum($campo, ['SP', 'CP'])->default('SP');
            });

            // 5. Copiar datos desde la columna temporal
            DB::statement("UPDATE historial_clinicos SET {$campo} = {$campo}_temp");

            // 6. Eliminar columna temporal
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->dropColumn($campo . '_temp');
            });
        }
    }

    public function down()
    {
        $sistemas = [
            'sist_cardiovascular', 'sist_respiratorio', 'sist_digestivo', 'sist_renal', 'sist_neurologico',
            'sist_musculoesqueletico', 'sist_endocrino', 'sist_hematologico', 'sist_linfatico',
            'sist_genitourinario', 'sist_piel', 'sist_oftalmologico', 'sist_orl', 'sist_psiquiatrico'
        ];

        foreach ($sistemas as $campo) {
            // Crear columna temporal
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->boolean($campo . '_temp')->default(0);
            });

            // Convertir SP/CP a booleanos
            DB::statement("UPDATE historial_clinicos SET {$campo}_temp = CASE WHEN {$campo} = 'CP' THEN 1 ELSE 0 END");

            // Eliminar columna original
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->dropColumn($campo);
            });

            // Crear columna como boolean
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->boolean($campo)->default(0);
            });

            // Copiar datos
            DB::statement("UPDATE historial_clinicos SET {$campo} = {$campo}_temp");

            // Eliminar temporal
            Schema::table('historial_clinicos', function (Blueprint $table) use ($campo) {
                $table->dropColumn($campo . '_temp');
            });
        }
    }
};