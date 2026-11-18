<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoExamenesSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar la tabla antes de insertar (opcional, pero útil para evitar duplicados)
        // DB::table('examenes')->truncate();

        $examenes = [
            // ==================== HEMATOLOGÍA ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Hemograma Automatizado'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Reticulocitos'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'VSG'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Glucosa 6 Fosfato'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Plasmodio en gota gruesa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Grupo Sanguíneo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Plaquetas'],

            // ==================== HEMOSTASIA ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'Tiempo de Coagulación'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'Tiempo Sangría'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'TP'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'TPT'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'Fibrinógeno'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'Dímero D'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hemostasia', 'nombre' => 'Anticoagulante Lúpico'],

            // ==================== AUTO INMUNIDAD ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Reacción de Widal'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'V.D.R.L'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Astro cuantitativo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'P.C.R. Cuantitativo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Factor Reumatoideo Cuantitativo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Procalcitonina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Complemento C3'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Complemento C4'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anti Péptido citrulinado'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anti fosfolípidos'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anticardiolipinas'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anticoagulantes Lúpico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anticitoplasma de neutrófilos (anca)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'A. Antinucleares (ana)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anti Dna'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Anti Ena'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Inmunoglobulina G'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Le Test'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'IgA'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'IgG'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'IgM'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'IgE'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Auto Inmunidad', 'nombre' => 'Histamina'],

            // ==================== QUÍMICAS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Glucosa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Glucosa Post-Prandial'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Tolerancia a la Glucosa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Hemoglobina Glicosilada'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Fructosamina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Colesterol Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'HDL Colesterol'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'LDL Colesterol'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Triglicéridos'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Lípidos Totales'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Apolipoproteínas A1'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Apolipoproteínas B'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Lipoproteínas A'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Urea'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Creatinina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Ácido Úrico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Nitrógeno Uréico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Bilirrubina y Fracciones'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Hierro Sérico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Transferrina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Ferritina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Ácido Fólico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'PCR'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Cistatina C'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Químicas', 'nombre' => 'Vitamina D'],

            // ==================== ENZIMAS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'G.O.T'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'G.P.T'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Gamma G.T.'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Fosfatasa Alcalina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'CPK Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'CPK MB'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Deshidrogenasa Láctica'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Amilasa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Lipasa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Colinesterasa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Enzimas', 'nombre' => 'Troponina I'],

            // ==================== INFECCIOSAS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Hiv 1+2'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Hepatitis A'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Hepatitis B'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Hepatitis C'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Anticuerpos Antihelicobacter Pylori'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Anticuerpos - Anticuerpos'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Dengue'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Dengue Ag 1er. Día'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Toxo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Rubeola'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Citomegalovirus'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Herpes I'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Herpes II'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'Chlamydia'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Infecciosas', 'nombre' => 'TORCH'],

            // ==================== HORMONAS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'T3 T4 TS H'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Anti-TIPO microsomales'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Anti Tiroglobulina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Tiroglobulina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Prolactina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Progesterona'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Estradiol'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'FSH'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'LH'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Testosterona'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Testosterona Libre'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Hormona de Crecimiento'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Cortisol AM-PM'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'DHEAS'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Gonadotrofina Coriónica Cuantitativa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Pro BNP'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Parato Hormona PTH'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Insulina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Insulina Post Prandial'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Homa IR'],

            // ==================== MARCADORES TUMORALES ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'PSA Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'PSA Libre'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'Alfafetoproteína'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'Antígeno Carcinoembrionario'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'CA 125 (Ovario y Útero)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'CA 15-3 (Mama)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'CA 19-9 (Páncreas y Estómago)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'CA 72-4 (Estómago)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'Cyfra-21-1(Pulmón)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'Enolasa Neurón Específica'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Marcadores Tumorales', 'nombre' => 'Indice Roma'],

            // ==================== ELECTROLITOS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Electrolitos', 'nombre' => 'Sodio Potasio Calcio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Electrolitos', 'nombre' => 'Sodio Potasio Cloro'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Electrolitos', 'nombre' => 'Fósforo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Electrolitos', 'nombre' => 'Calcio Iónico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Electrolitos', 'nombre' => 'Magnesio Lípidos y Ph'],

            // ==================== PATOLOGÍA ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Patología', 'nombre' => 'Papanicolau'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Patología', 'nombre' => 'Citología de _______'],

            // ==================== ORINAS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Físico, Químico, Sedimento'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Gota fresca'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Sodio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Potasio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Microalbuminuria'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Proteinuria en 24 Horas'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Amilasuria'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Test de Embarazo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Orinas', 'nombre' => 'Depuración de Creatinina 24 Horas'],

            // ==================== HECES ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Parasitología y Digestivo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Moco Fecal'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Sangre Oculta'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Glucosa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Ph'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Rotavirus'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Helicobacter Pylori'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Método Rápido'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Método Cuantitativo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Heces', 'nombre' => 'Rotavirus + Adenovirus'],

            // ==================== ESPUTO ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Esputo', 'nombre' => 'BDK'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Esputo', 'nombre' => 'BDK Seriado por ____ días'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Esputo', 'nombre' => 'Gram'],

            // ==================== MICROBIOLOGÍA ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Fresco'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Gram'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Cultivo de Heces'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Cultivo de Secreción de _______'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Cultivo Faringeo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Exudado Nasal'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Exudado Óptico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Exudado Vaginal'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Exudado Uretral'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Exudado Ocular'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Espermo Cultivo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Urocultivo'],

            // ==================== OTROS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Embarazo en Sangre'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Citología en Moco Nasal'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Espermograma Standard'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'STREP A'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Covid Cuantitativo IgG - IgM'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Covid Cuantitativo IgG - IgA'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Covid Antígeno nasofaríngeo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Otros', 'nombre' => 'Covid anticuerpos neutralizantes post VACUNACIÓN'],

            // ==================== NIVELES DE FÁRMACOS Y DROGAS ====================
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Digoxina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Fenitoina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Carbamazepina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Marihuana'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Cocaína'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Alcohol'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Fármacos y Drogas', 'nombre' => 'Multidrogas'],
        ];

        // Insertar los exámenes (evitando duplicados si ya existen)
        foreach ($examenes as $examen) {
            DB::table('examenes')->updateOrInsert(
                ['nombre' => $examen['nombre'], 'subcategoria' => $examen['subcategoria']],
                $examen
            );
        }
    }
}
