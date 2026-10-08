<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminoPredictivo extends Model
{
    use HasFactory;
    
    protected $table = 'terminos_predictivos';
    
    protected $fillable = [
        'campo',
        'termino',
        'veces_usado'
    ];
}