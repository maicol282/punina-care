<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('certificados_medicos', function (Blueprint $table) { // <-- CAMBIA EL NOMBRE DE LA TABLA
            $table->boolean('enviado')->default(false)->after('id');
            $table->timestamp('fecha_envio')->nullable()->after('enviado');
        });
    }
    public function down(): void {
        Schema::table('certificados_medicos', function (Blueprint $table) { // <-- CAMBIA EL NOMBRE DE LA TABLA
            $table->dropColumn(['enviado', 'fecha_envio']);
        });
    }
};