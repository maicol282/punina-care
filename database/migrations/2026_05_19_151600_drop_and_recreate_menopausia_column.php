<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Verificar si la tabla existe
        if (Schema::hasTable('historial_clinicos')) {
            // Primero, eliminar la restricción de NOT NULL
            DB::statement('ALTER TABLE historial_clinicos MODIFY menopausia VARCHAR(50) NULL');
        }
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE historial_clinicos MODIFY menopausia VARCHAR(50) NOT NULL');
    }
};