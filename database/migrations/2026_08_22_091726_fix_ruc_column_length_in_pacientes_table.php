<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Cambiar ruc a TEXT para soportar datos encriptados
        DB::statement('ALTER TABLE pacientes MODIFY ruc TEXT NULL');
        
        // También asegurar que otras columnas encriptadas sean TEXT
        DB::statement('ALTER TABLE pacientes MODIFY razon_social TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion_fiscal TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY telefono_facturacion TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY email_facturacion TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY observaciones TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY alergias TEXT NULL');
    }

    public function down()
    {
        // Revertir a VARCHAR
        DB::statement('ALTER TABLE pacientes MODIFY ruc VARCHAR(50) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY razon_social VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion_fiscal VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY telefono_facturacion VARCHAR(50) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY email_facturacion VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY observaciones TEXT NULL');
        DB::statement('ALTER TABLE pacientes MODIFY alergias TEXT NULL');
    }
};