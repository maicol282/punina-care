<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_clinicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->date('fecha_consulta');
            $table->string('motivo_consulta');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('medicamentos')->nullable();
            $table->string('presion_arterial')->nullable();
            $table->decimal('temperatura', 4, 2)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 3, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->string('doctor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_clinicos');
    }
};