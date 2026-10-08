<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Verificar si la columna fmu existe
        if (Schema::hasColumn('historial_clinicos', 'fmu')) {
            // Enfoque: Crear una columna nueva y migrar los datos
            Schema::table('historial_clinicos', function (Blueprint $table) {
                $table->date('fmu_nueva')->nullable()->after('fmu');
            });
            
            // Migrar datos válidos
            DB::statement("UPDATE historial_clinicos SET fmu_nueva = CAST(fmu AS DATE) WHERE fmu IS NOT NULL AND fmu != '' AND fmu != 'No aplica'");
            
            // Eliminar columna vieja
            Schema::table('historial_clinicos', function (Blueprint $table) {
                $table->dropColumn('fmu');
            });
            
            // Renombrar la nueva columna
            Schema::table('historial_clinicos', function (Blueprint $table) {
                $table->renameColumn('fmu_nueva', 'fmu');
            });
        }
    }

    public function down(): void
    {
        // No es necesario revertir
    }
};