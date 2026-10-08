<?php

namespace Database\Seeders;

use App\Models\Cie10Code;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportCie10FromSmartMedicalCodexSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('seeders/smc_icd10.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("Archivo CSV no encontrado: {$csvFile}");
            $this->command->info("Descárgalo con:");
            $this->command->info("curl -L -o database/seeders/smc_icd10.csv https://raw.githubusercontent.com/SmartMedicalCodex/smc-augmented-dataset/main/SMC_icd10_augmented_dataset.csv");
            return;
        }

        $this->command->info("📂 Importando CIE-10 desde SmartMedicalCodex...");

        $handle = fopen($csvFile, 'r');
        $header = fgetcsv($handle, 0, ',');

        $this->command->info("Columnas detectadas: " . implode(', ', $header));

        // Buscar columnas correctas
        $colCodigo = array_search('icd10_code', $header);
        if ($colCodigo === false) {
            $colCodigo = array_search('code', $header);
        }
        if ($colCodigo === false) {
            $colCodigo = array_search('codigo', $header);
        }

        $colDescripcion = array_search('text', $header);
        if ($colDescripcion === false) {
            $colDescripcion = array_search('descripcion', $header);
        }
        if ($colDescripcion === false) {
            $colDescripcion = array_search('description', $header);
        }

        if ($colCodigo === false || $colDescripcion === false) {
            $this->command->error("No se encontraron las columnas necesarias.");
            $this->command->info("Columnas disponibles: " . implode(', ', $header));
            fclose($handle);
            return;
        }

        $this->command->info("🔍 Columna código: " . $header[$colCodigo]);
        $this->command->info("🔍 Columna descripción: " . $header[$colDescripcion]);

        $batchSize = 1000;
        $data = [];
        $total = 0;
        $errores = 0;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $codigo = trim($row[$colCodigo] ?? '');
            $diagnostico = trim($row[$colDescripcion] ?? '');

            // Limpiar puntos del código
            $codigo = str_replace('.', '', $codigo);

            if (empty($codigo) || empty($diagnostico)) {
                $errores++;
                continue;
            }

            $data[] = [
                'codigo' => $codigo,
                'diagnostico' => $diagnostico,
                'categoria' => $this->getCategoriaFromCode($codigo),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $total++;

            if (count($data) >= $batchSize) {
                DB::table('cie10_codes')->insertOrIgnore($data);
                $this->command->line("📊 Procesados {$total} registros...");
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('cie10_codes')->insertOrIgnore($data);
        }

        fclose($handle);

        $this->command->newLine();
        $this->command->info("✅ Importación completada");
        $this->command->info("📊 Total registros procesados: {$total}");
        $this->command->info("⚠️ Registros con errores: {$errores}");
        $this->command->info("📊 Total registros en BD: " . Cie10Code::count());
    }

    private function getCategoriaFromCode(string $codigo): string
    {
        if (empty($codigo)) {
            return 'No clasificado';
        }

        // Obtener la primera letra del código
        $letra = substr($codigo, 0, 1);

        $categorias = [
            'A' => 'A00-B99 - Infecciosas y parasitarias',
            'B' => 'A00-B99 - Infecciosas y parasitarias',
            'C' => 'C00-D48 - Neoplasias',
            'D' => 'C00-D48 - Neoplasias',
            'E' => 'E00-E90 - Endocrinas y metabólicas',
            'F' => 'F00-F99 - Trastornos mentales',
            'G' => 'G00-G99 - Sistema nervioso',
            'H' => 'H00-H59 - Ojo y anexos',
            'I' => 'I00-I99 - Sistema circulatorio',
            'J' => 'J00-J99 - Sistema respiratorio',
            'K' => 'K00-K93 - Sistema digestivo',
            'L' => 'L00-L99 - Piel y tejido subcutáneo',
            'M' => 'M00-M99 - Sistema osteomuscular',
            'N' => 'N00-N99 - Sistema genitourinario',
            'O' => 'O00-O99 - Embarazo, parto y puerperio',
            'P' => 'P00-P96 - Perinatal',
            'Q' => 'Q00-Q99 - Malformaciones congénitas',
            'R' => 'R00-R99 - Síntomas y signos',
            'S' => 'S00-T98 - Traumatismos',
            'T' => 'S00-T98 - Traumatismos',
            'V' => 'V01-Y98 - Causas externas',
            'W' => 'V01-Y98 - Causas externas',
            'X' => 'V01-Y98 - Causas externas',
            'Y' => 'V01-Y98 - Causas externas',
            'Z' => 'Z00-Z99 - Factores salud',
        ];

        return $categorias[$letra] ?? 'No clasificado';
    }
}