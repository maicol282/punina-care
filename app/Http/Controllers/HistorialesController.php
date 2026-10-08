<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use Illuminate\Http\Request;

class HistorialesController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    
    $query = HistorialClinico::with(['paciente', 'recetas']); // Cargar recetas
    
    if ($search) {
        $query->whereHas('paciente', function($q) use ($search) {
            $q->where('nombre', 'LIKE', "%{$search}%")
              ->orWhere('apellido', 'LIKE', "%{$search}%")
              ->orWhere('cedula', 'LIKE', "%{$search}%");
        });
    }
    
// Filtros avanzados
    if ($request->filled('fecha_inicio')) {
        $query->whereDate('fecha_consulta', '>=', $request->fecha_inicio);
    }
    if ($request->filled('fecha_fin')) {
        $query->whereDate('fecha_consulta', '<=', $request->fecha_fin);
    }
    if ($request->filled('doctor')) {
        $query->where('doctor', 'LIKE', "%{$request->doctor}%");
    }
    if ($request->filled('diagnostico')) {
        $query->where('diagnostico', 'LIKE', "%{$request->diagnostico}%")
              ->orWhere('diagnostico_presuntivo', 'LIKE', "%{$request->diagnostico}%");
    }
    
    $historiales = $query->orderBy('fecha_consulta', 'desc')
        ->paginate(15)
        ->appends($request->query());
    
    return view('historiales.index', compact('historiales'));
}
}