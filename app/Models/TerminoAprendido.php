<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminoAprendido extends Model
{
    use HasFactory;
    
    protected $table = 'terminos_aprendidos';
    
    protected $fillable = [
        'campo',
        'termino',
        'veces_usado'
    ];
}