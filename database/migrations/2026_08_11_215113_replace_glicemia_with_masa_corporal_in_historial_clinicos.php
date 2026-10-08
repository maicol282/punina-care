<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            if (Schema::hasColumn('historial_clinicos', 'glicemia')) {
                $table->dropColumn('glicemia');
            }
            
            if (!Schema::hasColumn('historial_clinicos', 'masa_corporal')) {
                $table->decimal('masa_corporal', 5, 2)->nullable()->after('altura');
            }
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            if (Schema::hasColumn('historial_clinicos', 'masa_corporal')) {
                $table->dropColumn('masa_corporal');
            }
            $table->string('glicemia', 50)->nullable();
        });
    }
};