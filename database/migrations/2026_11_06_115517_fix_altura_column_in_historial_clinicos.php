<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->decimal('altura', 5, 2)->nullable()->change();
            $table->decimal('peso', 5, 2)->nullable()->change();
            $table->decimal('masa_corporal', 5, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->decimal('altura', 3, 2)->nullable()->change();
            $table->decimal('peso', 3, 2)->nullable()->change();
            $table->decimal('masa_corporal', 3, 2)->nullable()->change();
        });
    }
};