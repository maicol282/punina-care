<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use App\Models\Receta;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Http\Request;

class ExportacionController extends Controller
{
    /**
     * Exportar todos los pacientes
     */
    public function exportPacientes()
    {
        $pacientes = Paciente::all();
        $nombreArchivo = 'pacientes_' . date('Ymd_His') . '.xlsx';
        
        $tempFile = tempnam(sys_get_temp_dir(), 'excel_');
        
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($tempFile);
        
        $headers = [
            'ID', 'Cédula', 'Nombre', 'Apellido', 'Nombre Completo',
            'Fecha Nacimiento', 'Edad', 'Género', 'Teléfono', 'Email',
            'Dirección', 'País', 'Provincia', 'Ciudad', 'Ocupación',
            'Alergias', 'Observaciones', 'Fecha Registro'
        ];
        
        $writer->addRow(WriterEntityFactory::createRowFromArray($headers));
        
        foreach ($pacientes as $paciente) {
            $row = [
                $paciente->id,
                $paciente->cedula ?? '',
                $paciente->nombre,
                $paciente->apellido,
                $paciente->nombre_completo,
                $paciente->fecha_nacimiento->format('d/m/Y'),
                $paciente->edad,
                $paciente->genero == 'M' ? 'Masculino' : ($paciente->genero == 'F' ? 'Femenino' : 'Otro'),
                $paciente->telefono,
                $paciente->email,
                $paciente->direccion,
                $paciente->pais ?? '',
                $paciente->provincia ?? '',
                $paciente->ciudad ?? '',
                $paciente->ocupacion ?? '',
                $paciente->alergias ?? '',
                $paciente->observaciones ?? '',
                $paciente->created_at->format('d/m/Y H:i')
            ];
            $writer->addRow(WriterEntityFactory::createRowFromArray($row));
        }
        
        $writer->close();
        
        return response()->download($tempFile, $nombreArchivo, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Exportar historial de un paciente específico (con su nombre)
     */
    public function exportHistorialPaciente(Paciente $paciente)
    {
        $historiales = $paciente->historialClinicos;
        $nombreArchivo = 'historial_' . str_replace(' ', '_', $paciente->nombre_completo) . '_' . date('Ymd_His') . '.xlsx';
        
        $tempFile = tempnam(sys_get_temp_dir(), 'excel_');
        
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($tempFile);
        
        $headers = [
            'ID', 'Paciente', 'Cédula', 'Fecha Consulta', 'Doctor',
            'Motivo Consulta', 'Diagnóstico Presuntivo', 'CIE-10 Presuntivo',
            'Diagnóstico Definitivo', 'CIE-10 Definitivo', 'Tratamiento',
            'Recomendaciones', 'Observaciones'
        ];
        
        $writer->addRow(WriterEntityFactory::createRowFromArray($headers));
        
        foreach ($historiales as $historial) {
            $row = [
                $historial->id,
                $historial->paciente->nombre_completo,
                $historial->paciente->cedula ?? '',
                $historial->fecha_consulta->format('d/m/Y'),
                $historial->doctor ?? '',
                $historial->motivo_consulta,
                $historial->diagnostico_presuntivo ?? '',
                $historial->cie10_presuntivo ?? '',
                $historial->diagnostico,
                $historial->cie10_definitivo ?? $historial->cie10_code ?? '',
                $historial->tratamiento ?? '',
                $historial->recomendaciones ?? '',
                $historial->observaciones ?? ''
            ];
            $writer->addRow(WriterEntityFactory::createRowFromArray($row));
        }
        
        $writer->close();
        
        return response()->download($tempFile, $nombreArchivo, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Exportar todos los historiales
     */
    public function exportAllHistoriales()
    {
        $historiales = HistorialClinico::with('paciente')->get();
        $nombreArchivo = 'historiales_' . date('Ymd_His') . '.xlsx';
        
        $tempFile = tempnam(sys_get_temp_dir(), 'excel_');
        
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($tempFile);
        
        $headers = [
            'ID', 'Paciente', 'Cédula', 'Fecha Consulta', 'Doctor',
            'Motivo Consulta', 'Diagnóstico Presuntivo', 'CIE-10 Presuntivo',
            'Diagnóstico Definitivo', 'CIE-10 Definitivo', 'Tratamiento',
            'Recomendaciones', 'Observaciones'
        ];
        
        $writer->addRow(WriterEntityFactory::createRowFromArray($headers));
        
        foreach ($historiales as $historial) {
            $row = [
                $historial->id,
                $historial->paciente->nombre_completo,
                $historial->paciente->cedula ?? '',
                $historial->fecha_consulta->format('d/m/Y'),
                $historial->doctor ?? '',
                $historial->motivo_consulta,
                $historial->diagnostico_presuntivo ?? '',
                $historial->cie10_presuntivo ?? '',
                $historial->diagnostico,
                $historial->cie10_definitivo ?? $historial->cie10_code ?? '',
                $historial->tratamiento ?? '',
                $historial->recomendaciones ?? '',
                $historial->observaciones ?? ''
            ];
            $writer->addRow(WriterEntityFactory::createRowFromArray($row));
        }
        
        $writer->close();
        
        return response()->download($tempFile, $nombreArchivo, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Exportar recetas de un paciente específico
     */
    public function exportRecetasPaciente(Paciente $paciente)
    {
        $recetas = Receta::whereHas('historialClinico', function($q) use ($paciente) {
            $q->where('paciente_id', $paciente->id);
        })->with('historialClinico.paciente')->get();
        
        $nombreArchivo = 'recetas_' . str_replace(' ', '_', $paciente->nombre_completo) . '_' . date('Ymd_His') . '.xlsx';
        
        $tempFile = tempnam(sys_get_temp_dir(), 'excel_');
        
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($tempFile);
        
        $headers = [
            'ID', 'Paciente', 'Cédula', 'Fecha Emisión', 'Medicamento',
            'Presentación', 'Concentración', 'Dosis', 'Frecuencia', 'Duración',
            'Indicaciones', 'Advertencias', 'Signos de Alarma', 'Recomendaciones No Farmacológicas'
        ];
        
        $writer->addRow(WriterEntityFactory::createRowFromArray($headers));
        
        foreach ($recetas as $receta) {
            $row = [
                $receta->id,
                $receta->historialClinico->paciente->nombre_completo,
                $receta->historialClinico->paciente->cedula ?? '',
                $receta->fecha_emision->format('d/m/Y'),
                $receta->medicamento,
                $receta->presentacion ?? '',
                $receta->concentracion ?? '',
                $receta->dosis,
                $receta->frecuencia,
                $receta->duracion,
                $receta->indicaciones ?? '',
                $receta->advertencias ?? '',
                $receta->signos_alarma ?? '',
                $receta->recomendaciones_no_farmacologicas ?? ''
            ];
            $writer->addRow(WriterEntityFactory::createRowFromArray($row));
        }
        
        $writer->close();
        
        return response()->download($tempFile, $nombreArchivo, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Exportar todas las recetas
     */
    public function exportAllRecetas()
    {
        $recetas = Receta::with('historialClinico.paciente')->get();
        $nombreArchivo = 'recetas_' . date('Ymd_His') . '.xlsx';
        
        $tempFile = tempnam(sys_get_temp_dir(), 'excel_');
        
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($tempFile);
        
        $headers = [
            'ID', 'Paciente', 'Cédula', 'Fecha Emisión', 'Medicamento',
            'Presentación', 'Concentración', 'Dosis', 'Frecuencia', 'Duración',
            'Indicaciones', 'Advertencias', 'Signos de Alarma', 'Recomendaciones No Farmacológicas'
        ];
        
        $writer->addRow(WriterEntityFactory::createRowFromArray($headers));
        
        foreach ($recetas as $receta) {
            $row = [
                $receta->id,
                $receta->historialClinico->paciente->nombre_completo,
                $receta->historialClinico->paciente->cedula ?? '',
                $receta->fecha_emision->format('d/m/Y'),
                $receta->medicamento,
                $receta->presentacion ?? '',
                $receta->concentracion ?? '',
                $receta->dosis,
                $receta->frecuencia,
                $receta->duracion,
                $receta->indicaciones ?? '',
                $receta->advertencias ?? '',
                $receta->signos_alarma ?? '',
                $receta->recomendaciones_no_farmacologicas ?? ''
            ];
            $writer->addRow(WriterEntityFactory::createRowFromArray($row));
        }
        
        $writer->close();
        
        return response()->download($tempFile, $nombreArchivo, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}