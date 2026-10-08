<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historial_clinico_id')->constrained()->onDelete('cascade');
            $table->text('descripcion');
            $table->string('cie10_code', 20)->nullable();
            $table->enum('tipo', ['PRE', 'DEF'])->default('PRE');
            $table->integer('orden')->default(0);
            $table->timestamps();
            
            $table->index('historial_clinico_id');
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
