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
use App\Helpers\PercentageHelper;
class SeguridadDashboardController extends Controller
{
    public function index()
    {
        // ============ ESTADÍSTICAS BÁSICAS ============
        $totalPacientes = Paciente::count();
        $totalHistoriales = HistorialClinico::count();
        $totalSeguimientos = Seguimiento::count();
        
        // Próximas citas (placeholder)
        $proximasCitas = collect([]);

        // ============ MESES PARA GRÁFICOS ============
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

        // ============ CONSULTAS POR MES ============
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

        // ============ PACIENTES POR GÉNERO (con porcentaje) ============
        $pacientesGenero = PercentageHelper::addPercentage(
            Paciente::select('genero', DB::raw('COUNT(*) as total'))
                ->groupBy('genero')
                ->get(),
            $totalPacientes
        );

        // ============ PACIENTES POR MES ============
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

        // ============ RANGOS DE EDAD (con porcentaje) ============
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
                if ($edad < 18) { $rangosEdad['0-17 años']++; }
                elseif ($edad <= 30) { $rangosEdad['18-30 años']++; }
                elseif ($edad <= 45) { $rangosEdad['31-45 años']++; }
                elseif ($edad <= 60) { $rangosEdad['46-60 años']++; }
                else { $rangosEdad['60+ años']++; }
            } else { $rangosEdad['Sin especificar']++; }
        }
        
        $edadesStats = collect($rangosEdad)->map(function($total, $rango) use ($totalPacientes) {
            return (object) [
                'rango_edad' => $rango, 
                'total' => $total,
                'porcentaje' => $totalPacientes > 0 ? round(($total / $totalPacientes) * 100, 1) : 0
            ];
        })->filter(function($item) {
            return $item->total > 0;
        })->values();

        // ============ TOP 5 DIAGNÓSTICOS (con porcentaje) ============
        $topDiagnosticos = PercentageHelper::addPercentage(
            Diagnostico::select('descripcion', DB::raw('COUNT(*) as total'))
                ->whereNotNull('descripcion')
                ->groupBy('descripcion')
                ->orderBy('total', 'desc')
                ->take(5)
                ->get(),
            $totalHistoriales
        );

        // ============ TOP 5 MÉDICOS (con porcentaje) ============
        $topMedicos = PercentageHelper::addPercentage(
            HistorialClinico::select('doctor', DB::raw('COUNT(*) as total'))
                ->whereNotNull('doctor')
                ->where('doctor', '!=', '')
                ->groupBy('doctor')
                ->orderBy('total', 'desc')
                ->take(5)
                ->get(),
            $totalHistoriales
        );

        // ============ TOP CIE-10 (con porcentaje) ============
        $topCie10 = PercentageHelper::addPercentage(
            Diagnostico::select('cie10_code', DB::raw('COUNT(*) as total'))
                ->whereNotNull('cie10_code')
                ->where('cie10_code', '!=', '')
                ->groupBy('cie10_code')
                ->orderBy('total', 'desc')
                ->take(5)
                ->get(),
            $totalHistoriales
        );

        // ============ ÚLTIMOS PACIENTES ============
        $ultimosPacientes = Paciente::orderBy('created_at', 'desc')->take(5)->get();

        // ============ ACTIVIDAD RECIENTE ============
        $actividadReciente = HistorialClinico::with('paciente')
            ->orderBy('created_at', 'desc')->take(5)->get();

        // ============ ESTADÍSTICAS GEOGRÁFICAS (con porcentaje) ============
        $pacientesPorCiudad = PercentageHelper::addPercentage(
            Paciente::select('ciudad', DB::raw('count(*) as total'))
                ->whereNotNull('ciudad')
                ->where('ciudad', '!=', '')
                ->groupBy('ciudad')
                ->orderBy('total', 'desc')
                ->get(),
            $totalPacientes
        );

        $pacientesPorProvincia = PercentageHelper::addPercentage(
            Paciente::select('provincia', DB::raw('count(*) as total'))
                ->whereNotNull('provincia')
                ->where('provincia', '!=', '')
                ->groupBy('provincia')
                ->orderBy('total', 'desc')
                ->get(),
            $totalPacientes
        );

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
            'actividadReciente',
            'pacientesPorCiudad',
            'pacientesPorProvincia'
        ));
    }
        public function exportarExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\EstadisticasExport(),
            'estadisticas-' . date('Y-m-d') . '.xlsx'
        );
    }
}