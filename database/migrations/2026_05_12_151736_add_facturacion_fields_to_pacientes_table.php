<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            // Datos de facturación SRI Ecuador
            $table->string('ruc', 13)->nullable()->after('cedula');
            $table->string('razon_social', 200)->nullable()->after('ruc');
            $table->string('direccion_fiscal', 255)->nullable()->after('razon_social');
            $table->string('telefono_facturacion', 20)->nullable()->after('direccion_fiscal');
            $table->string('email_facturacion', 100)->nullable()->after('telefono_facturacion');
            $table->boolean('obligado_contabilidad')->default(false)->after('email_facturacion');
            $table->boolean('contribuyente_especial')->default(false)->after('obligado_contabilidad');
            $table->boolean('agente_retencion')->default(false)->after('contribuyente_especial');
        });
    }

    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn([
                'ruc', 'razon_social', 'direccion_fiscal', 'telefono_facturacion',
                'email_facturacion', 'obligado_contabilidad', 'contribuyente_especial',
                'agente_retencion'
            ]);
        });
    }
};