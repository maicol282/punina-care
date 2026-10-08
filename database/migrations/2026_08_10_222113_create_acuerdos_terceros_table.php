<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acuerdos_terceros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tercero');
            $table->string('tipo_servicio');
            $table->string('responsable');
            $table->string('email_contacto');
            $table->string('telefono_contacto');
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->text('descripcion_servicio');
            $table->json('datos_compartidos');
            $table->json('medidas_seguridad');
            $table->string('tiempo_respuesta');
            $table->text('clausulas_terminacion');
            $table->enum('estado', ['activo', 'vencido', 'cancelado'])->default('activo');
            $table->string('documento')->nullable();
            $table->text('firma')->nullable();
            $table->text('notas')->nullable();
            $table->boolean('dpd_compliance')->default(true);
            $table->timestamp('last_audit_at')->nullable();
            $table->timestamps();
            
            $table->index('nombre_tercero');
            $table->index('estado');
            $table->index('fecha_vencimiento');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acuerdos_terceros');
    }
};