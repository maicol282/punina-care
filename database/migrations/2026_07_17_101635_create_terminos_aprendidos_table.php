<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terminos_aprendidos', function (Blueprint $table) {
            $table->id();
            $table->string('campo'); // motivo_consulta, diagnostico, etc.
            $table->string('termino');
            $table->integer('veces_usado')->default(1);
            $table->timestamps();
            
            $table->unique(['campo', 'termino']);
            $table->index(['campo', 'veces_usado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terminos_aprendidos');
    }
};