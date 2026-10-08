<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cie10_codes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->string('diagnostico');
            $table->text('descripcion')->nullable();
            $table->string('categoria', 50)->nullable(); // Aumentar a 50 caracteres
            $table->timestamps();
            
            $table->index('codigo');
            $table->index('categoria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cie10_codes');
    }
};