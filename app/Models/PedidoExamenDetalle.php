<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoExamenDetalle extends Model
{
    use HasFactory;

    protected $table = 'pedido_examen_detalle';

    protected $fillable = [
        'pedido_examen_id',
        'examen_id',
        'observaciones',
    ];

    // Relaciones
    public function pedido()
    {
        return $this->belongsTo(PedidoExamen::class, 'pedido_examen_id');
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
    }
}