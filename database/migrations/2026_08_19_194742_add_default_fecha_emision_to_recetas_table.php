<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->date('fecha_emision')->default(now())->change();
        });
    }

    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->date('fecha_emision')->nullable()->change();
        });
    }
};