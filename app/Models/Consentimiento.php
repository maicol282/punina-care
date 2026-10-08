<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Consentimiento extends Model
{
    use HasFactory;

    protected $table = 'consentimientos';

    protected $fillable = [
        'paciente_id',
        'user_id',
        'tipo_consentimiento',
        'descripcion',
        'alcance',
        'fecha_consentimiento',
        'fecha_revocacion',
        'estado',
        'condiciones_especificas',
        'metodo_registro',
        'ip_registro',
        'observaciones',
        'version',
    ];

    protected $casts = [
        'condiciones_especificas' => 'array',
        'fecha_consentimiento' => 'date',
        'fecha_revocacion' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActivo(Builder $query): Builder
    {
        return $query->where('estado', 'activo');
    }

    public function scopeRevocado(Builder $query): Builder
    {
        return $query->where('estado', 'revocado');
    }
}