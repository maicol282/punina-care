<?php

namespace App\Exports;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use App\Models\Diagnostico;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Export;  // <-- Agregamos esto

class EstadisticasExport implements Export, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new GeneroSheet(),
            new EdadSheet(),
            new MedicosSheet(),
            new DiagnosticosSheet(),
            new Cie10Sheet(),
            new CiudadSheet(),
            new ProvinciaSheet(),
        ];
    }
}

/* ============================================
   HOJA: PACIENTES POR GÉNERO
   ============================================ */
class GeneroSheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'Género'; }
    public function headings(): array { return ['Género', 'Total', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = Paciente::count();
        return Paciente::select('genero', \DB::raw('COUNT(*) as total'))
            ->groupBy('genero')
            ->get()
            ->map(function ($item) use ($total) {
                $porcentaje = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
                return [$item->genero ?? 'No especificado', $item->total, $porcentaje];
            })->toArray();
    }
}

/* ============================================
   HOJA: DISTRIBUCIÓN POR EDAD
   ============================================ */
class EdadSheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'Edad'; }
    public function headings(): array { return ['Rango de Edad', 'Total', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = Paciente::count();
        $rangos = ['0-17 años' => 0, '18-30 años' => 0, '31-45 años' => 0, '46-60 años' => 0, '60+ años' => 0, 'Sin especificar' => 0];
        $pacientes = Paciente::whereNotNull('fecha_nacimiento')->get();
        foreach ($pacientes as $p) {
            $edad = \Carbon\Carbon::parse($p->fecha_nacimiento)->age;
            if ($edad < 18) $rangos['0-17 años']++;
            elseif ($edad <= 30) $rangos['18-30 años']++;
            elseif ($edad <= 45) $rangos['31-45 años']++;
            elseif ($edad <= 60) $rangos['46-60 años']++;
            else $rangos['60+ años']++;
        }
        $data = [];
        foreach ($rangos as $rango => $totalRango) {
            if ($totalRango > 0) {
                $data[] = [$rango, $totalRango, $total > 0 ? round(($totalRango / $total) * 100, 1) : 0];
            }
        }
        return $data;
    }
}

/* ============================================
   HOJA: TOP MÉDICOS
   ============================================ */
class MedicosSheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'Médicos'; }
    public function headings(): array { return ['Médico', 'Consultas', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = HistorialClinico::count();
        return HistorialClinico::select('doctor', \DB::raw('COUNT(*) as total'))
            ->whereNotNull('doctor')->where('doctor', '!=', '')
            ->groupBy('doctor')->orderBy('total', 'desc')->take(10)->get()
            ->map(function ($item) use ($total) {
                $porcentaje = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
                return [$item->doctor, $item->total, $porcentaje];
            })->toArray();
    }
}

/* ============================================
   HOJA: TOP DIAGNÓSTICOS
   ============================================ */
class DiagnosticosSheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'Diagnósticos'; }
    public function headings(): array { return ['Diagnóstico', 'Total', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = Diagnostico::count();
        return Diagnostico::select('descripcion', \DB::raw('COUNT(*) as total'))
            ->whereNotNull('descripcion')
            ->groupBy('descripcion')->orderBy('total', 'desc')->take(10)->get()
            ->map(function ($item) use ($total) {
                $porcentaje = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
                return [$item->descripcion, $item->total, $porcentaje];
            })->toArray();
    }
}

/* ============================================
   HOJA: TOP CIE-10
   ============================================ */
class Cie10Sheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'CIE-10'; }
    public function headings(): array { return ['Código CIE-10', 'Total', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = Diagnostico::count();
        return Diagnostico::select('cie10_code', \DB::raw('COUNT(*) as total'))
            ->whereNotNull('cie10_code')->where('cie10_code', '!=', '')
            ->groupBy('cie10_code')->orderBy('total', 'desc')->take(10)->get()
            ->map(function ($item) use ($total) {
                $porcentaje = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
                return [$item->cie10_code, $item->total, $porcentaje];
            })->toArray();
    }
}

/* ============================================
   HOJA: PACIENTES POR CIUDAD
   ============================================ */
class CiudadSheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'Ciudades'; }
    public function headings(): array { return ['Ciudad', 'Pacientes', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = Paciente::count();
        return Paciente::select('ciudad', \DB::raw('COUNT(*) as total'))
            ->whereNotNull('ciudad')->where('ciudad', '!=', '')
            ->groupBy('ciudad')->orderBy('total', 'desc')->get()
            ->map(function ($item) use ($total) {
                $porcentaje = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
                return [$item->ciudad, $item->total, $porcentaje];
            })->toArray();
    }
}

/* ============================================
   HOJA: PACIENTES POR PROVINCIA
   ============================================ */
class ProvinciaSheet implements FromArray, WithTitle, WithHeadings
{
    public function title(): string { return 'Provincias'; }
    public function headings(): array { return ['Provincia', 'Pacientes', 'Porcentaje (%)']; }

    public function array(): array
    {
        $total = Paciente::count();
        return Paciente::select('provincia', \DB::raw('COUNT(*) as total'))
            ->whereNotNull('provincia')->where('provincia', '!=', '')
            ->groupBy('provincia')->orderBy('total', 'desc')->get()
            ->map(function ($item) use ($total) {
                $porcentaje = $total > 0 ? round(($item->total / $total) * 100, 1) : 0;
                return [$item->provincia, $item->total, $porcentaje];
            })->toArray();
    }
}