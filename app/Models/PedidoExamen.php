<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoExamen extends Model
{
    use HasFactory;

    protected $table = 'pedidos_examenes';

    protected $fillable = [
        'historial_clinico_id',
        'paciente_id',
        'medico_id',
        'fecha_pedido',
        'motivo',
        'resumen_clinico',
        'diagnostico_cie10',
        'estado',
    ];

    protected $casts = [
        'fecha_pedido' => 'date',
    ];

    // Relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function medico()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class, 'historial_clinico_id');
    }

    public function detalles()
    {
        return $this->hasMany(PedidoExamenDetalle::class, 'pedido_examen_id');
    }
}