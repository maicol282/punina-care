<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', 100); // Laboratorio, Imagenología, etc.
            $table->string('subcategoria', 100)->nullable();
            $table->string('nombre', 200);
            $table->string('codigo', 50)->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examenes');
    }
};
