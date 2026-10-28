<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('certificado_p12')->nullable()->after('firma_path');
            $table->text('certificado_password')->nullable()->after('certificado_p12');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['certificado_p12', 'certificado_password']);
        });
    }
};