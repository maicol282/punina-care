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
            if (!auth()->user()->hasAnyRole(['Administrador', 'Médico'])) {
    abort(403, 'No tienes permiso para acceder a esta sección.');
            }
        
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
            'Neonato / Recién nacido (0 a 28 días)' => 0,
            'Lactante menor (1 a 11 meses)' => 0,
            'Lactante mayor (12 a 23 meses)' => 0,
            'Preescolar (2 a 5 años)' => 0,
            'Escolar (6 a 11 años)' => 0,
            'Adolescente (12 a 19 años)' => 0,
            'Adulto joven (20 a 39 años)' => 0,
            'Adulto maduro / medio (40 a 59 años)' => 0,
            'Adulto mayor (Vejez) (60+ años)' => 0,
            'Sin especificar' => 0
        ];
        
        foreach ($pacientes as $paciente) {
            if ($paciente->fecha_nacimiento) {
                $fechaNac = Carbon::parse($paciente->fecha_nacimiento);
                $edad = $fechaNac->age;
                $meses = $fechaNac->diffInMonths(now());
                $dias = $fechaNac->diffInDays(now());
                
                if ($dias <= 28) { $rangosEdad['Neonato / Recién nacido (0 a 28 días)']++; }
                elseif ($meses >= 1 && $meses <= 11) { $rangosEdad['Lactante menor (1 a 11 meses)']++; }
                elseif ($meses >= 12 && $meses <= 23) { $rangosEdad['Lactante mayor (12 a 23 meses)']++; }
                elseif ($edad >= 2 && $edad <= 5) { $rangosEdad['Preescolar (2 a 5 años)']++; }
                elseif ($edad >= 6 && $edad <= 11) { $rangosEdad['Escolar (6 a 11 años)']++; }
                elseif ($edad >= 12 && $edad <= 19) { $rangosEdad['Adolescente (12 a 19 años)']++; }
                elseif ($edad >= 20 && $edad <= 39) { $rangosEdad['Adulto joven (20 a 39 años)']++; }
                elseif ($edad >= 40 && $edad <= 59) { $rangosEdad['Adulto maduro / medio (40 a 59 años)']++; }
                else { $rangosEdad['Adulto mayor (Vejez) (60+ años)']++; }
            } else { $rangosEdad['Sin especificar']++; }
        }
        
        $edadesStats = [];
        foreach ($rangosEdad as $rango => $total) {
            if ($total > 0) {
                $edadesStats[] = (object) [
                    'rango_edad' => $rango,
                    'total' => $total,
                    'porcentaje' => $totalPacientes > 0 ? round(($total / $totalPacientes) * 100, 1) : 0
                ];
            }
        }

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


        // ============ CIE-10 POR ATENCIÓN DE PACIENTES POR DOCTOR ============
        $cie10PorDoctor = HistorialClinico::select(
                'doctor',
                'cie10_code',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('doctor')
            ->where('doctor', '!=', '')
            ->whereNotNull('cie10_code')
            ->where('cie10_code', '!=', '')
            ->groupBy('doctor', 'cie10_code')
            ->orderBy('doctor')
            ->orderBy('total', 'desc')
            ->get()
            ->groupBy('doctor'); // Agrupar por doctor para facilitar la vista

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
            'pacientesPorProvincia',
            'cie10PorDoctor'
        ));
    }
        public function exportarExcel()
    {

            if (!auth()->user()->hasAnyRole(['Administrador', 'Médico'])) {
        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
    return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\EstadisticasExport(),
            'estadisticas-' . date('Y-m-d') . '.xlsx'
        );
    }
}