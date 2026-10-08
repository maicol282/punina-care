<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            // Cambiar cedula a 20 caracteres para soportar mas largos
            $table->string('cedula', 20)->change();
            
            // Tambien cambiar telefono por si acaso
            $table->string('telefono', 20)->change();
            
            // Y ruc que puede ser de 13 digitos
            $table->string('ruc', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cedula', 10)->change();
            $table->string('telefono', 15)->change();
            $table->string('ruc', 13)->change();
        });
    }
};
