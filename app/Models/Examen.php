<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examenes';

    protected $fillable = [
        'categoria',
        'subcategoria',
        'nombre',
        'codigo',
        'precio',
    ];

    // Un examen puede estar en muchos pedidos
    public function pedidos()
    {
        return $this->hasMany(PedidoExamenDetalle::class, 'examen_id');
    }
}