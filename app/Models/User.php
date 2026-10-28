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
        
    ];

    protected $fillable = [
        'name',
        'email',
        'especialidad',
        'cedula',
        'cedula_hash',
        'password',
        'firma_path',
        'certificado_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'certificado_password',
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

    
}