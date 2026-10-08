<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->json('medicamentos_json')->nullable()->after('medicamento');
        });
    }

    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->dropColumn('medicamentos_json');
        });
    }
};