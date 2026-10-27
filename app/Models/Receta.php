<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_clinico_id',
        'fecha_emision',
        'medicamento', 
        'medicamentos_json',
        'presentacion',
        'concentracion',
        'dosis',
        'frecuencia',
        'duracion',
        'indicaciones',
        'advertencias',
        'signos_alarma',
        'recomendaciones_no_farmacologicas'
    ];

    protected $casts = [
        'fecha_emision' => 'date',
    ];

    // ===== VALORES POR DEFECTO =====
    protected $attributes = [
        'dosis' => '',
        'presentacion' => '',
        'concentracion' => '',
        'frecuencia' => '',
        'duracion' => '',
        'indicaciones' => '',
        'advertencias' => '',
        'signos_alarma' => '',
        'recomendaciones_no_farmacologicas' => '',
    ];

    public function getDescripcionCompletaAttribute()
    {
        return "{$this->medicamento} - {$this->dosis} {$this->frecuencia} por {$this->duracion}";
    }
      
        /**
     * Relación con el historial clínico.
     */
    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class, 'historial_clinico_id');
    }

    /**
     * Obtener el paciente a través del historial clínico.
     */
    public function getPacienteAttribute()
    {
        return $this->historialClinico?->paciente;
    }
}