<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consentimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tipo_consentimiento');
            $table->text('descripcion');
            $table->text('alcance')->nullable();
            $table->date('fecha_consentimiento');
            $table->date('fecha_revocacion')->nullable();
            $table->string('estado')->default('activo');
            $table->json('condiciones_especificas')->nullable();
            $table->string('metodo_registro');
            $table->string('ip_registro')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('version')->default('1.0');
            $table->timestamps();
            
            $table->index('paciente_id');
            $table->index('tipo_consentimiento');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consentimientos');
    }
};