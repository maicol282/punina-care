<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudioAdjunto extends Model
{
    use HasFactory;

    // ESPECIFICAR EL NOMBRE CORRECTO DE LA TABLA
    protected $table = 'estudios_adjuntos';

    protected $fillable = [
        'historial_clinico_id',
        'nombre_original',
        'nombre_guardado',
        'ruta',
        'tipo_archivo',
        'mime_type',
        'tamano',
        'descripcion',
        'categoria'
    ];

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function getTamanoFormateadoAttribute()
    {
        $bytes = $this->tamano;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }

    public function getIconoAttribute()
    {
        $iconos = [
            'image/jpeg' => 'fa-file-image',
            'image/png' => 'fa-file-image',
            'image/gif' => 'fa-file-image',
            'image/webp' => 'fa-file-image',
            'application/pdf' => 'fa-file-pdf',
            'application/msword' => 'fa-file-word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-file-word',
            'application/vnd.ms-excel' => 'fa-file-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-file-excel',
        ];
        return $iconos[$this->mime_type] ?? 'fa-file';
    }

    public function getColorAttribute()
    {
        $colores = [
            'image/jpeg' => 'primary',
            'image/png' => 'primary',
            'image/gif' => 'primary',
            'image/webp' => 'primary',
            'application/pdf' => 'danger',
            'application/msword' => 'info',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'info',
            'application/vnd.ms-excel' => 'success',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'success',
        ];
        return $colores[$this->mime_type] ?? 'secondary';
    }
}