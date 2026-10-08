<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_clinico_id', 'fecha_seguimiento', 
        'evolucion', 'nuevos_sintomas', 'medicamentos_ajustados',
        'recomendaciones', 'proxima_cita'
    ];

    protected $casts = [
        'fecha_seguimiento' => 'date',
        'proxima_cita' => 'date',
    ];

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function getEstadoAttribute(): string
    {
        if ($this->proxima_cita && $this->proxima_cita->isFuture()) {
            return 'En seguimiento';
        }
        return 'Completado';
    }
}
