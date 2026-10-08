<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Verificar si la columna 'especialidad' ya existe
            if (!Schema::hasColumn('users', 'especialidad')) {
                $table->string('especialidad')->nullable()->after('name');
            }
            
            // Verificar si la columna 'cedula' ya existe
            if (!Schema::hasColumn('users', 'cedula')) {
                $table->string('cedula')->nullable()->after('especialidad');
            }
            
            // Verificar si la columna 'firma_path' ya existe
            if (!Schema::hasColumn('users', 'firma_path')) {
                $table->string('firma_path')->nullable()->after('cedula');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'firma_path')) {
                $table->dropColumn('firma_path');
            }
            if (Schema::hasColumn('users', 'cedula')) {
                $table->dropColumn('cedula');
            }
            if (Schema::hasColumn('users', 'especialidad')) {
                $table->dropColumn('especialidad');
            }
        });
    }
};