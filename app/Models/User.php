<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Encryptable;

    protected $encryptable = [
        'email',
        'cedula',
    ];

    protected $fillable = [
        'name',
        'email',
        'especialidad',
        'cedula',
        'cedula_hash',
        'password',
        'firma_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function getFirmaUrlAttribute()
    {
        if ($this->firma_path) {
            return asset('storage/' . $this->firma_path);
        }
        return null;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function consultas()
    {
        return $this->hasMany(HistorialClinico::class, 'doctor', 'name');
    }
    public function consultasTelemedicina()
    {
    return $this->hasMany(ConsultaTelemedicina::class, 'medico_id');
    }

        /**
     * Mutador para la cédula: cada vez que se asigna una cédula,
     * se calcula automáticamente su hash SHA-256 para búsquedas rápidas.
     */
    public function setCedulaAttribute($value)
    {
        // 1. Limpiamos la cédula: quitamos TODO lo que no sea número
        $cedulaLimpia = $value ? preg_replace('/[^0-9]/', '', $value) : null;
        
        // 2. Guardamos la cédula limpia (el trait Encryptable la encriptará)
        $this->attributes['cedula'] = $cedulaLimpia;
        
        // 3. Calculamos el hash usando la cédula 100% numérica
        $this->attributes['cedula_hash'] = $cedulaLimpia ? hash('sha256', $cedulaLimpia) : null;
    }
}