<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            // Sistema Cardiovascular
            $table->boolean('sist_cardiovascular')->default(false);
            $table->text('sist_cardiovascular_obs')->nullable();
            
            // Sistema Respiratorio
            $table->boolean('sist_respiratorio')->default(false);
            $table->text('sist_respiratorio_obs')->nullable();
            
            // Sistema Digestivo
            $table->boolean('sist_digestivo')->default(false);
            $table->text('sist_digestivo_obs')->nullable();
            
            // Sistema Renal
            $table->boolean('sist_renal')->default(false);
            $table->text('sist_renal_obs')->nullable();
            
            // Sistema Neurológico
            $table->boolean('sist_neurologico')->default(false);
            $table->text('sist_neurologico_obs')->nullable();
            
            // Sistema Musculoesquelético
            $table->boolean('sist_musculoesqueletico')->default(false);
            $table->text('sist_musculoesqueletico_obs')->nullable();
            
            // Sistema Endocrino
            $table->boolean('sist_endocrino')->default(false);
            $table->text('sist_endocrino_obs')->nullable();
            
            // Sistema Hematológico
            $table->boolean('sist_hematologico')->default(false);
            $table->text('sist_hematologico_obs')->nullable();
            
            // Sistema Linfático
            $table->boolean('sist_linfatico')->default(false);
            $table->text('sist_linfatico_obs')->nullable();
            
            // Sistema Genitourinario
            $table->boolean('sist_genitourinario')->default(false);
            $table->text('sist_genitourinario_obs')->nullable();
            
            // Piel y Anexos
            $table->boolean('sist_piel')->default(false);
            $table->text('sist_piel_obs')->nullable();
            
            // Sistema Oftalmológico
            $table->boolean('sist_oftalmologico')->default(false);
            $table->text('sist_oftalmologico_obs')->nullable();
            
            // Sistema ORL
            $table->boolean('sist_orl')->default(false);
            $table->text('sist_orl_obs')->nullable();
            
            // Sistema Psiquiátrico
            $table->boolean('sist_psiquiatrico')->default(false);
            $table->text('sist_psiquiatrico_obs')->nullable();
        });
    }

    public function down()
    {
        Schema::table('historial_clinicos', function (Blueprint $table) {
            $table->dropColumn([
                'sist_cardiovascular', 'sist_cardiovascular_obs',
                'sist_respiratorio', 'sist_respiratorio_obs',
                'sist_digestivo', 'sist_digestivo_obs',
                'sist_renal', 'sist_renal_obs',
                'sist_neurologico', 'sist_neurologico_obs',
                'sist_musculoesqueletico', 'sist_musculoesqueletico_obs',
                'sist_endocrino', 'sist_endocrino_obs',
                'sist_hematologico', 'sist_hematologico_obs',
                'sist_linfatico', 'sist_linfatico_obs',
                'sist_genitourinario', 'sist_genitourinario_obs',
                'sist_piel', 'sist_piel_obs',
                'sist_oftalmologico', 'sist_oftalmologico_obs',
                'sist_orl', 'sist_orl_obs',
                'sist_psiquiatrico', 'sist_psiquiatrico_obs'
            ]);
        });
    }
};