<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use App\Models\Seguimiento;
use App\Models\Diagnostico;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguridadDashboardController extends Controller
{
    public function index()
    {
        // ============ ESTADÍSTICAS BÁSICAS ============
        $totalPacientes = Paciente::count();
        $totalHistoriales = HistorialClinico::count();
        $totalSeguimientos = Seguimiento::count();
        
        // Próximas citas (placeholder - sin módulo de citas aún)
        $proximasCitas = collect([]);

        // ============ MESES PARA GRÁFICOS ============
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

        // ============ GRÁFICO: CONSULTAS POR MES ============
        $consultasPorMes = HistorialClinico::select(
            DB::raw('YEAR(fecha_consulta) as año'),
            DB::raw('MONTH(fecha_consulta) as mes'),
            DB::raw('COUNT(*) as total')
        )
        ->where('fecha_consulta', '>=', Carbon::now()->subYear())
        ->groupBy('año', 'mes')
        ->orderBy('año', 'asc')
        ->orderBy('mes', 'asc')
        ->get();

        // ============ GRÁFICO: PACIENTES POR GÉNERO ============
        $pacientesGenero = Paciente::select('genero', DB::raw('COUNT(*) as total'))
            ->groupBy('genero')
            ->get();

        // ============ GRÁFICO: NUEVOS PACIENTES POR MES ============
        $pacientesPorMes = Paciente::select(
            DB::raw('YEAR(created_at) as año'),
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subYear())
        ->groupBy('año', 'mes')
        ->orderBy('año', 'asc')
        ->orderBy('mes', 'asc')
        ->get();

        // ============ GRÁFICO: RANGOS DE EDAD (CALCULADA) ============
        $pacientes = Paciente::whereNotNull('fecha_nacimiento')->get();
        
        $rangosEdad = [
            '0-17 años' => 0,
            '18-30 años' => 0,
            '31-45 años' => 0,
            '46-60 años' => 0,
            '60+ años' => 0,
            'Sin especificar' => 0
        ];
        
        foreach ($pacientes as $paciente) {
            if ($paciente->fecha_nacimiento) {
                $edad = Carbon::parse($paciente->fecha_nacimiento)->age;
                
                if ($edad < 18) {
                    $rangosEdad['0-17 años']++;
                } elseif ($edad <= 30) {
                    $rangosEdad['18-30 años']++;
                } elseif ($edad <= 45) {
                    $rangosEdad['31-45 años']++;
                } elseif ($edad <= 60) {
                    $rangosEdad['46-60 años']++;
                } else {
                    $rangosEdad['60+ años']++;
                }
            } else {
                $rangosEdad['Sin especificar']++;
            }
        }
        
        $edadesStats = collect($rangosEdad)->map(function($total, $rango) {
            return (object) ['rango_edad' => $rango, 'total' => $total];
        })->filter(function($item) {
            return $item->total > 0;
        })->values();

        // ============ GRÁFICO: TOP 5 DIAGNÓSTICOS ============
        $topDiagnosticos = Diagnostico::select('descripcion', DB::raw('COUNT(*) as total'))
            ->whereNotNull('descripcion')
            ->groupBy('descripcion')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // ============ GRÁFICO: TOP 5 MÉDICOS ============
        $topMedicos = HistorialClinico::select('doctor', DB::raw('COUNT(*) as total'))
            ->whereNotNull('doctor')
            ->where('doctor', '!=', '')
            ->groupBy('doctor')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // ============ GRÁFICO: TOP CIE-10 ============
        $topCie10 = Diagnostico::select('cie10_code', DB::raw('COUNT(*) as total'))
            ->whereNotNull('cie10_code')
            ->where('cie10_code', '!=', '')
            ->groupBy('cie10_code')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // ============ ÚLTIMOS PACIENTES ============
        $ultimosPacientes = Paciente::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ============ ACTIVIDAD RECIENTE ============
        $actividadReciente = HistorialClinico::with('paciente')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('seguridad.dashboard', compact(
            'totalPacientes',
            'totalHistoriales',
            'totalSeguimientos',
            'proximasCitas',
            'meses',
            'consultasPorMes',
            'pacientesGenero',
            'pacientesPorMes',
            'edadesStats',
            'topDiagnosticos',
            'topMedicos',
            'topCie10',
            'ultimosPacientes',
            'actividadReciente'
        ));
    }
}