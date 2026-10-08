<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Método 1: Usar DB::statement para modificar directamente
        try {
            DB::statement('ALTER TABLE historial_clinicos MODIFY menopausia VARCHAR(50) NULL');
        } catch (\Exception $e) {
            // Si falla, intentamos con otro enfoque
            Schema::table('historial_clinicos', function (Blueprint $table) {
                $table->string('menopausia', 50)->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->string('menopausia', 50)->nullable(false)->change();
        });
    }
};