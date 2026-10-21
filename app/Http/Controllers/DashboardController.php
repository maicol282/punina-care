<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use App\Models\Seguimiento;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // app/Http/Controllers/DashboardController.php

public function index()
{
    $totalPacientes = Paciente::count();
    $totalHistoriales = HistorialClinico::count();
    $totalSeguimientos = Seguimiento::count();
    
    // Pacientes por género
    $pacientesGenero = Paciente::select('genero', DB::raw('count(*) as total'))
        ->groupBy('genero')
        ->get();
    
    // Pacientes por rangos de edad (reemplaza a $sangreStats)
    $edadesStats = Paciente::selectRaw("
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) < 12 THEN '0-11 años'
            WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 12 AND 17 THEN '12-17 años'
            WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 30 THEN '18-30 años'
            WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 31 AND 45 THEN '31-45 años'
            WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 46 AND 60 THEN '46-60 años'
            ELSE '60+ años'
        END as rango_edad,
        COUNT(*) as total
    ")->groupBy('rango_edad')->get();
    
    // Próximas citas
    $proximasCitas = Seguimiento::with('historialClinico.paciente')
        ->whereBetween('proxima_cita', [now(), now()->addDays(7)])
        ->orderBy('proxima_cita')
        ->take(10)
        ->get();
    
    // Últimos pacientes
    $ultimosPacientes = Paciente::latest()->take(5)->get();
    
    // Consultas por mes
    $consultasPorMes = HistorialClinico::select(
            DB::raw('YEAR(fecha_consulta) as año'),
            DB::raw('MONTH(fecha_consulta) as mes'),
            DB::raw('count(*) as total')
        )
        ->where('fecha_consulta', '>=', now()->subMonths(12))
        ->groupBy('año', 'mes')
        ->orderBy('año', 'asc')
        ->orderBy('mes', 'asc')
        ->get();
    
    // Pacientes por mes
    $pacientesPorMes = Paciente::select(
            DB::raw('YEAR(created_at) as año'),
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(12))
        ->groupBy('año', 'mes')
        ->orderBy('año', 'asc')
        ->orderBy('mes', 'asc')
        ->get();
    
    // Top médicos
    $topMedicos = HistorialClinico::select('doctor', DB::raw('count(*) as total'))
        ->whereNotNull('doctor')
        ->groupBy('doctor')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();
    
    // Top diagnósticos
    $topDiagnosticos = HistorialClinico::select('diagnostico', DB::raw('count(*) as total'))
        ->whereNotNull('diagnostico')
        ->groupBy('diagnostico')
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();
    
    // Consultas por especialidad
    $consultasPorEspecialidad = HistorialClinico::whereNotNull('doctor')
        ->join('users', 'historial_clinicos.doctor', '=', 'users.name')
        ->select('users.especialidad', DB::raw('count(*) as total'))
        ->whereNotNull('users.especialidad')
        ->groupBy('users.especialidad')
        ->orderBy('total', 'desc')
        ->get();
    
    // Top CIE-10 (con manejo de error)
$topCie10 = collect(); // colección vacía por defecto

try {
    $topCie10 = HistorialClinico::select('cie10_code as codigo', DB::raw('count(*) as total'))
        ->whereNotNull('cie10_code')
        ->groupBy('cie10_code')
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();
} catch (\Exception $e) {
    \Log::warning('Error al obtener top CIE-10: ' . $e->getMessage());
}

    // Pacientes por ciudad CON PORCENTAJE
    $pacientesPorCiudad = Paciente::select('ciudad', DB::raw('count(*) as total'))
        ->whereNotNull('ciudad')
        ->where('ciudad', '!=', '')
        ->groupBy('ciudad')
        ->orderBy('total', 'desc')
        ->get()
        ->map(function ($item) use ($totalPacientes) {
            $item->porcentaje = $totalPacientes > 0 ? round(($item->total / $totalPacientes) * 100, 1) : 0;
            return $item;
        });

    // Pacientes por provincia CON PORCENTAJE
    $pacientesPorProvincia = Paciente::select('provincia', DB::raw('count(*) as total'))
        ->whereNotNull('provincia')
        ->where('provincia', '!=', '')
        ->groupBy('provincia')
        ->orderBy('total', 'desc')
        ->get()
        ->map(function ($item) use ($totalPacientes) {
            $item->porcentaje = $totalPacientes > 0 ? round(($item->total / $totalPacientes) * 100, 1) : 0;
            return $item;
        });
    
    return view('dashboard', compact(
        'totalPacientes',
        'totalHistoriales',
        'totalSeguimientos',
        'pacientesGenero',
        'edadesStats',           
        'proximasCitas',
        'ultimosPacientes',
        'consultasPorMes',
        'pacientesPorMes',
        'topMedicos',
        'topDiagnosticos',
        'consultasPorEspecialidad',
        'topCie10'
        'pacientesPorCiudad',    
        'pacientesPorProvincia'
    ));
}
}