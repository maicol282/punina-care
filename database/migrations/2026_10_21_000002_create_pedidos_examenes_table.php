<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos_examenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->nullable()->constrained('historial_clinicos')->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_pedido');
            $table->text('motivo')->nullable();
            $table->text('resumen_clinico')->nullable();
            $table->string('diagnostico_cie10', 50)->nullable();
            $table->enum('estado', ['pendiente', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos_examenes');
    }
};
