<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory, Encryptable;

    protected $fillable = [
        'nombre', 'apellido', 'fecha_nacimiento', 'genero', 
        'tipo_sangre', 'telefono', 'email','cedula','ocupacion','direccion','alergias',
        'pais', 'provincia', 'ciudad', 'ruc', 'razon_social',
        'direccion_fiscal', 'telefono_facturacion', 'email_facturacion',
        'obligado_contabilidad', 'contribuyente_especial', 'agente_retencion',
        'observaciones'
    ];

    protected $encryptable = [
        'cedula',
        'telefono',
        'email',
        'direccion',
        'alergias',
        'observaciones',
        'ruc',
        'razon_social',
        'direccion_fiscal',
        'telefono_facturacion',
        'email_facturacion',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'obligado_contabilidad' => 'boolean',
        'contribuyente_especial' => 'boolean',
        'agente_retencion' => 'boolean',
    ];

    public function historialClinicos()
    {
        return $this->hasMany(HistorialClinico::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellido}");
    }

    public function reposos()
    {
    return $this->hasMany(Reposo::class);
    }

    public function getEdadAttribute(): int
    {
        if ($this->fecha_nacimiento) {
            return $this->fecha_nacimiento->age;
        }
        return 0;
    }
    public function certificadosMedicos()
    {
    return $this->hasMany(CertificadoMedico::class);
    }
    public function consultasTelemedicina()
    {
    return $this->hasMany(ConsultaTelemedicina::class);
    }
}