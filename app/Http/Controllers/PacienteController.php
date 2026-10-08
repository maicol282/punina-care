<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    // Eliminamos el __construct() con middlewares

    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = Paciente::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('telefono', 'LIKE', "%{$search}%")
                  ->orWhere('cedula', 'LIKE', "%{$search}%");
            });
        }
        
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }
        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }
        if ($request->filled('ciudad')) {
            $query->where('ciudad', 'LIKE', "%{$request->ciudad}%");
        }
        if ($request->filled('ocupacion')) {
            $query->where('ocupacion', 'LIKE', "%{$request->ocupacion}%");
        }
        
        $pacientes = $query->withCount('historialClinicos')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->query());
        
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:M,F,Otro',
            'tipo_sangre' => 'nullable|string|max:10',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:pacientes',
            'cedula' => 'nullable|string|size:10|unique:pacientes|regex:/^[0-9]{10}$/',
            'ocupacion' => 'nullable|string|max:100',
            'alergias' => 'nullable|string',
            'direccion' => 'required|string',
            'pais' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'ruc' => 'nullable|string|max:13',
            'razon_social' => 'nullable|string|max:255',
            'direccion_fiscal' => 'nullable|string|max:255',
            'telefono_facturacion' => 'nullable|string|max:20',
            'email_facturacion' => 'nullable|email|max:100',
            'obligado_contabilidad' => 'nullable|boolean',
            'contribuyente_especial' => 'nullable|boolean',
            'agente_retencion' => 'nullable|boolean',
            'observaciones' => 'nullable|string'
        ]);

        Paciente::create($validated);

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente registrado exitosamente.');
    }

    public function show(Paciente $paciente)
{
    $paciente->load(['historialClinicos' => function($query) {
        $query->with('diagnosticos')->withCount('seguimientos')->latest();
    }]);
    
    return view('pacientes.show', compact('paciente'));
}

    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:M,F,Otro',
            'tipo_sangre' => 'nullable|string|max:10',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:pacientes,email,' . $paciente->id,
            'cedula' => 'nullable|string|size:10|unique:pacientes,cedula,' . $paciente->id . '|regex:/^[0-9]{10}$/',
            'ocupacion' => 'nullable|string|max:100',
            'alergias' => 'nullable|string',
            'direccion' => 'required|string',
            'pais' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'ruc' => 'nullable|string|max:13',
            'razon_social' => 'nullable|string|max:255',
            'direccion_fiscal' => 'nullable|string|max:255',
            'telefono_facturacion' => 'nullable|string|max:20',
            'email_facturacion' => 'nullable|email|max:100',
            'obligado_contabilidad' => 'nullable|boolean',
            'contribuyente_especial' => 'nullable|boolean',
            'agente_retencion' => 'nullable|boolean',
            'observaciones' => 'nullable|string'
        ]);

        $paciente->update($validated);

        return redirect()->route('pacientes.show', $paciente)
            ->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy(Paciente $paciente)
    {
        try {
            if ($paciente->historialClinicos()->count() > 0) {
                return redirect()->route('pacientes.index')
                    ->with('error', 'No se puede eliminar el paciente porque tiene historiales clínicos asociados.');
            }
            
            $paciente->delete();
            
            return redirect()->route('pacientes.index')
                ->with('success', 'Paciente eliminado exitosamente.');
                
        } catch (\Exception $e) {
            return redirect()->route('pacientes.index')
                ->with('error', 'Error al eliminar el paciente: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        return redirect()->route('pacientes.index', ['search' => $request->get('search')]);
    }
}