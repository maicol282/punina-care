<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Diagnóstico Presuntivo
            $table->string('cie10_presuntivo', 10)->nullable()->after('cie10_code');
            $table->text('diagnostico_presuntivo')->nullable()->after('cie10_presuntivo');
            
            // Diagnóstico Definitivo (renombrar campos existentes o agregar nuevos)
            $table->string('cie10_definitivo', 10)->nullable()->after('diagnostico');
            
            // Tratamiento y Recomendaciones
            $table->text('recomendaciones')->nullable()->after('tratamiento');
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->dropColumn([
                'cie10_presuntivo',
                'diagnostico_presuntivo',
                'cie10_definitivo',
                'recomendaciones'
            ]);
        });
    }
};