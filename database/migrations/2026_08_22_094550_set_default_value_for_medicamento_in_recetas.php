<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Establecer un valor por defecto para la columna 'medicamento'
        DB::table('recetas')->whereNull('medicamento')->update(['medicamento' => '']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No hay reversa para esta operación
    }
};
