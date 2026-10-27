<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoMedico extends Model
{
    use HasFactory;

    protected $table = 'certificados_medicos';

    protected $fillable = [
        'historial_clinico_id',
        'paciente_id',
        'paciente_nombre',
        'paciente_cedula',
        'paciente_direccion',
        'paciente_telefono',
        'paciente_empresa',
        'paciente_puesto',
        'fecha_atencion',
        'diagnosticos',
        'tipo_contingencia',
        'reposo',
        'reposo_inicio',
        'reposo_fin',
        'reposo_dias',
        'observaciones',
        'medico_nombre',
        'medico_cedula',
        'medico_especialidad',
        'estado',
        'enviado',       
        'fecha_envio'    
    ];

    protected $casts = [
        'fecha_atencion' => 'date',
        'reposo_inicio' => 'date',
        'reposo_fin' => 'date',
        'reposo' => 'boolean',
        'enviado' => 'boolean',
        'fecha_envio' => 'datetime',
    ];

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class, 'historial_clinico_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function getTipoContingenciaLabelAttribute()
    {
        $tipos = [
            'enfermedad_general' => 'Enfermedad General',
            'maternidad' => 'Maternidad',
            'enfermedad_catastrofica' => 'Enfermedad Catastrófica',
            'accidente_laboral' => 'Presunción de Accidente Laboral',
            'enfermedad_laboral' => 'Presunción de Enfermedad Laboral u Ocupacional'
        ];
        return $tipos[$this->tipo_contingencia] ?? $this->tipo_contingencia;
    }

    public function getEstadoLabelAttribute()
    {
        $estados = [
            'activo' => 'Activo',
            'anulado' => 'Anulado'
        ];
        return $estados[$this->estado] ?? $this->estado;
    }

    public function getNumeroCertificadoAttribute()
    {
        return 'CERT-' . date('Y') . '-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

}

