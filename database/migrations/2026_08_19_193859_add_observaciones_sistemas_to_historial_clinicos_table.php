<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Verificar si la columna no existe antes de crearla
            if (!Schema::hasColumn('historial_clinicos', 'observaciones_sistemas')) {
                $table->text('observaciones_sistemas')->nullable()->after('sist_psiquiatrico_obs');
            }
        });
    }

    public function down()
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            if (Schema::hasColumn('historial_clinicos', 'observaciones_sistemas')) {
                $table->dropColumn('observaciones_sistemas');
            }
        });
    }
};