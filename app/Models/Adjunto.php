<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_clinico_id',
        'nombre_original',
        'ruta',
        'tipo',
        'descripcion',
        'tamano',
        'mime_type',
        'hash_integridad',
        'encrypt_version',
    ];

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function getTamañoFormateadoAttribute()
    {
        $bytes = $this->tamano;
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}