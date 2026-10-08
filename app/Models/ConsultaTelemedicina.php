<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaTelemedicina extends Model
{
    use HasFactory;

        protected $table = 'consultas_telemedicina';

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'historial_clinico_id',
        'fecha_hora_programada',
        'duracion',
        'sala_nombre',
        'estado',
        'motivo',
        'notas',
        'fecha_inicio_real',
        'fecha_fin_real',
    ];

    protected $casts = [
        'fecha_hora_programada' => 'datetime',
        'fecha_inicio_real' => 'datetime',
        'fecha_fin_real' => 'datetime',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function scopeProgramadas($query)
    {
        return $query->whereIn('estado', ['programada', 'en_curso']);
    }

    public static function generarSala()
    {
        return 'punina-' . uniqid() . '-' . date('YmdHis');
    }

    public function getEstadoLabelAttribute()
    {
        $estados = [
            'programada' => 'Programada',
            'en_curso' => 'En curso',
            'completada' => 'Completada',
            'cancelada' => 'Cancelada'
        ];
        return $estados[$this->estado] ?? $this->estado;
    }

    public function getEstadoColorAttribute()
    {
        $colores = [
            'programada' => 'primary',
            'en_curso' => 'warning',
            'completada' => 'success',
            'cancelada' => 'danger'
        ];
        return $colores[$this->estado] ?? 'secondary';
    }

    public function getEnlaceAccesoAttribute()
    {
        return 'https://meet.jit.si/' . $this->sala_nombre;
    }
}