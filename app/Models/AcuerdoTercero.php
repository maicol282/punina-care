<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AcuerdoTercero extends Model
{
    use HasFactory;

    protected $table = 'acuerdos_terceros';

    protected $fillable = [
        'nombre_tercero',
        'tipo_servicio',
        'responsable',
        'email_contacto',
        'telefono_contacto',
        'fecha_inicio',
        'fecha_vencimiento',
        'descripcion_servicio',
        'datos_compartidos',
        'medidas_seguridad',
        'tiempo_respuesta',
        'clausulas_terminacion',
        'estado',
        'documento',
        'firma',
        'notas',
        'dpd_compliance',
        'last_audit_at',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_vencimiento' => 'date',
        'datos_compartidos' => 'array',
        'medidas_seguridad' => 'array',
        'dpd_compliance' => 'boolean',
        'last_audit_at' => 'datetime',
    ];

    public function scopeActivo(Builder $query): Builder
    {
        return $query->where('estado', 'activo')
                    ->where('fecha_vencimiento', '>=', now());
    }

    public function scopeVencido(Builder $query): Builder
    {
        return $query->where('estado', 'activo')
                    ->where('fecha_vencimiento', '<', now());
    }

    public function scopePorVencer(Builder $query, int $days = 30): Builder
    {
        return $query->where('estado', 'activo')
                    ->where('fecha_vencimiento', '>=', now())
                    ->where('fecha_vencimiento', '<=', now()->addDays($days));
    }
}