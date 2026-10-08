<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->constrained()->onDelete('cascade');
            $table->date('fecha_seguimiento');
            $table->text('evolucion');
            $table->text('nuevos_sintomas')->nullable();
            $table->text('medicamentos_ajustados')->nullable();
            $table->text('recomendaciones');
            $table->date('proxima_cita')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};