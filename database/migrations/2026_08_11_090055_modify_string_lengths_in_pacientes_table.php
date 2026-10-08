<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            // Aumentar longitud de campos que seran encriptados
            $table->string('cedula', 255)->change();
            $table->string('telefono', 255)->change();
            $table->string('email', 255)->change();
            $table->string('ruc', 255)->change();
            $table->string('razon_social', 255)->change();
            $table->string('direccion_fiscal', 255)->change();
            $table->string('telefono_facturacion', 255)->change();
            $table->string('email_facturacion', 255)->change();
            
            // Otros campos que podrian necesitar mas espacio
            $table->string('direccion', 255)->change();
            $table->string('alergias', 255)->change();
            $table->string('ocupacion', 255)->change();
            $table->string('pais', 100)->change();
            $table->string('provincia', 100)->change();
            $table->string('ciudad', 100)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            // Revertir a longitudes originales
            $table->string('cedula', 20)->change();
            $table->string('telefono', 20)->change();
            $table->string('email', 100)->change();
            $table->string('ruc', 20)->change();
            $table->string('razon_social', 100)->change();
            $table->string('direccion_fiscal', 200)->change();
            $table->string('telefono_facturacion', 20)->change();
            $table->string('email_facturacion', 100)->change();
            $table->string('direccion', 200)->change();
            $table->string('alergias', 200)->change();
            $table->string('ocupacion', 100)->change();
            $table->string('pais', 50)->change();
            $table->string('provincia', 50)->change();
            $table->string('ciudad', 50)->change();
        });
    }
};