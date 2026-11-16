<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->date('fecha_emision_factura')->nullable()->after('agente_retencion');
            $table->decimal('precio_consulta', 10, 2)->nullable()->after('fecha_emision_factura');
            $table->boolean('pagado')->default(false)->after('precio_consulta');
        });
    }

    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn(['fecha_emision_factura', 'precio_consulta', 'pagado']);
        });
    }
};