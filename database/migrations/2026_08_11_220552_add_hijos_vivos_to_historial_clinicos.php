<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            if (!Schema::hasColumn('historial_clinicos', 'hijos_vivos')) {
                $table->integer('hijos_vivos')->nullable()->default(0)->after('cesareas');
            }
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            if (Schema::hasColumn('historial_clinicos', 'hijos_vivos')) {
                $table->dropColumn('hijos_vivos');
            }
        });
    }
};