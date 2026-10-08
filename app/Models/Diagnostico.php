<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_clinico_id',
        'descripcion',
        'cie10_code',
        'tipo',
        'orden',
    ];

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function getTipoLabelAttribute()
    {
        return $this->tipo === 'PRE' ? 'Presuntivo' : 'Definitivo';
    }
}