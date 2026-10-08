<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reposo extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_clinico_id',
        'paciente_id',
        'fecha_inicio',
        'fecha_fin',
        'dias',
        'tipo',
        'diagnostico',
        'recomendaciones',
        'medico_emisor',
        'numero_reposo',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopePorPaciente($query, $pacienteId)
    {
        return $query->where('paciente_id', $pacienteId);
    }

    public static function generarNumero()
    {
        $ultimo = self::orderBy('id', 'desc')->first();
        $numero = $ultimo ? intval(substr($ultimo->numero_reposo, -4)) + 1 : 1;
        return 'REP-' . date('Y') . '-' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }

    public function getTipoLabelAttribute()
    {
        $tipos = [
            'laboral' => 'Laboral',
            'escolar' => 'Escolar',
            'otro' => 'Otro'
        ];
        return $tipos[$this->tipo] ?? $this->tipo;
    }

    public function getEstadoLabelAttribute()
    {
        $estados = [
            'activo' => 'Activo',
            'completado' => 'Completado',
            'anulado' => 'Anulado'
        ];
        return $estados[$this->estado] ?? $this->estado;
    }

    public function getEstadoColorAttribute()
    {
        $colores = [
            'activo' => 'success',
            'completado' => 'info',
            'anulado' => 'danger'
        ];
        return $colores[$this->estado] ?? 'secondary';
    }
}