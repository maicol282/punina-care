<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cie10Code extends Model
{
    use HasFactory;

    protected $table = 'cie10_codes';

    protected $fillable = [
        'codigo',
        'diagnostico',
        'categoria',
    ];

    // Scope para búsqueda
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function($q) use ($search) {
            $q->where('codigo', 'LIKE', "%{$search}%")
              ->orWhere('diagnostico', 'LIKE', "%{$search}%");
        });
    }
}
