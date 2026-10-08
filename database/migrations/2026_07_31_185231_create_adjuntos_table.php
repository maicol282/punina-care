<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adjuntos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('nombre_original');
            $table->string('ruta');
            $table->string('tipo');
            $table->text('descripcion')->nullable();
            $table->bigInteger('tamano');
            $table->string('mime_type');
            $table->string('hash_integridad')->nullable();
            $table->string('encrypt_version')->default('1.0');
            $table->timestamps();
            
            $table->index('historial_clinico_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adjuntos');
    }
};