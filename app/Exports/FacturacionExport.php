<?php

namespace App\Exports;

use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Enumerable;

class FacturacionExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return Enumerable
     */
    public function collection(): Enumerable
    {
        return Paciente::whereNotNull('ruc')
            ->orWhereNotNull('razon_social')
            ->orWhereNotNull('precio_consulta')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Paciente',
            'Cédula',
            'RUC',
            'Razón Social',
            'Dirección Fiscal',
            'Teléfono Facturación',
            'Email Facturación',
            'Fecha Emisión Factura',
            'Precio Consulta',
            'Pagado',
        ];
    }

    public function map($paciente): array
    {
        return [
            $paciente->id,
            $paciente->nombre_completo,
            $paciente->cedula,
            $paciente->ruc,
            $paciente->razon_social,
            $paciente->direccion_fiscal,
            $paciente->telefono_facturacion,
            $paciente->email_facturacion,
            $paciente->fecha_emision_factura ? $paciente->fecha_emision_factura->format('d/m/Y') : 'N/A',
            $paciente->precio_consulta ? number_format($paciente->precio_consulta, 2) : '0.00',
            $paciente->pagado ? 'Sí' : 'No',
        ];
    }
}
