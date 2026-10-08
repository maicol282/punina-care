<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Primero, truncar los datos existentes que sean muy largos
        DB::statement('UPDATE pacientes SET telefono_facturacion = LEFT(telefono_facturacion, 50) WHERE LENGTH(telefono_facturacion) > 50');
        DB::statement('UPDATE pacientes SET ruc = LEFT(ruc, 20) WHERE LENGTH(ruc) > 20');
        DB::statement('UPDATE pacientes SET email_facturacion = LEFT(email_facturacion, 255) WHERE LENGTH(email_facturacion) > 255');
        DB::statement('UPDATE pacientes SET razon_social = LEFT(razon_social, 500) WHERE LENGTH(razon_social) > 500');
        DB::statement('UPDATE pacientes SET direccion_fiscal = LEFT(direccion_fiscal, 500) WHERE LENGTH(direccion_fiscal) > 500');
        DB::statement('UPDATE pacientes SET direccion = LEFT(direccion, 500) WHERE LENGTH(direccion) > 500');

        // Luego modificar las columnas
        DB::statement('ALTER TABLE pacientes MODIFY telefono_facturacion VARCHAR(50) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY ruc VARCHAR(20) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY email_facturacion VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY razon_social VARCHAR(500) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion_fiscal VARCHAR(500) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion VARCHAR(500) NULL');
    }

    public function down()
    {
        // Revertir cambios (opcional)
        DB::statement('ALTER TABLE pacientes MODIFY telefono_facturacion VARCHAR(20) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY ruc VARCHAR(20) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY email_facturacion VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY razon_social VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion_fiscal VARCHAR(255) NULL');
        DB::statement('ALTER TABLE pacientes MODIFY direccion VARCHAR(255) NULL');
    }
};