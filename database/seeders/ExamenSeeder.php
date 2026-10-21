<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoExamenesSeeder extends Seeder
{
    public function run(): void
    {
        $examenes = [
            // HEMATOLOGÍA
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Biometría Hemática Completa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Hemoglobina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Hematocrito'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Recuento de Plaquetas'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Velocidad de Sedimentación (VSG)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Grupo Sanguíneo y Factor Rh'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Tiempo de Protrombina (TP)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Tiempo de Tromboplastina (TPT)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Fibrinógeno'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hematología', 'nombre' => 'Reticulocitos'],

            // QUÍMICA SANGUÍNEA
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Glucosa Basal'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Glucosa Postprandial'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Hemoglobina Glicosilada (HbA1c)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Urea'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Creatinina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Ácido Úrico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Colesterol Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Colesterol HDL'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Colesterol LDL'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Triglicéridos'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'TGO (AST)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'TGP (ALT)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Bilirrubina Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Bilirrubina Directa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Bilirrubina Indirecta'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Fosfatasa Alcalina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Amilasa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Lipasa'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Proteínas Totales'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Albúmina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Calcio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Fósforo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Magnesio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Sodio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Potasio'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Química Sanguínea', 'nombre' => 'Cloro'],

            // INMUNOLOGÍA
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'VIH 1 y 2'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'VDRL (Sífilis)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Hepatitis B (HBsAg)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Hepatitis C (Anti-VHC)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Toxoplasma IgG / IgM'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Rubéola IgG / IgM'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Citomegalovirus (CMV) IgG / IgM'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Proteína C Reactiva (PCR)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Factor Reumatoide'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Inmunología', 'nombre' => 'Antiestreptolisina O (ASO)'],

            // HORMONAS
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'TSH (Hormona Tiroestimulante)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'T3 Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'T4 Total'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'T3 Libre'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'T4 Libre'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Prolactina'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'FSH (Hormona Folículo Estimulante)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'LH (Hormona Luteinizante)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Estradiol'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Progesterona'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Testosterona'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Hormonas', 'nombre' => 'Cortisol'],

            // UROANÁLISIS
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Uroanálisis', 'nombre' => 'Examen General de Orina (EGO)'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Uroanálisis', 'nombre' => 'Urocultivo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Uroanálisis', 'nombre' => 'Microalbuminuria'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Uroanálisis', 'nombre' => 'Depuración de Creatinina'],

            // MICROBIOLOGÍA
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Examen Coprológico'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Coprocultivo'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Sangre Oculta en Heces'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Gram de Secreción'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'Cultivo de Secreción'],
            ['categoria' => 'Laboratorio', 'subcategoria' => 'Microbiología', 'nombre' => 'BAAR (Baciloscopía)'],

            // IMAGENOLOGÍA - RAYOS X
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Tórax PA'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Tórax Lateral'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Columna Cervical'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Columna Lumbar'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Abdomen Simple'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Cráneo'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Pelvis'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Rodilla'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Hombro'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Rayos X', 'nombre' => 'Rayos X de Senos Paranasales'],

            // IMAGENOLOGÍA - ECOGRAFÍA
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Abdominal'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Pélvica'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Renal'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Tiroidea'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Mamaria'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Obstétrica'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Transvaginal'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Ecografía', 'nombre' => 'Ecografía Prostática'],

            // IMAGENOLOGÍA - TOMOGRAFÍA
            ['categoria' => 'Imagenología', 'subcategoria' => 'Tomografía', 'nombre' => 'TAC de Cráneo Simple'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Tomografía', 'nombre' => 'TAC de Cráneo Contrastado'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Tomografía', 'nombre' => 'TAC de Tórax'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Tomografía', 'nombre' => 'TAC de Abdomen'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Tomografía', 'nombre' => 'TAC de Senos Paranasales'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Tomografía', 'nombre' => 'TAC de Columna Lumbar'],

            // IMAGENOLOGÍA - RESONANCIA
            ['categoria' => 'Imagenología', 'subcategoria' => 'Resonancia', 'nombre' => 'Resonancia Magnética de Cráneo'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Resonancia', 'nombre' => 'Resonancia Magnética de Columna'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Resonancia', 'nombre' => 'Resonancia Magnética de Rodilla'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Resonancia', 'nombre' => 'Resonancia Magnética de Hombro'],
            ['categoria' => 'Imagenología', 'subcategoria' => 'Resonancia', 'nombre' => 'Resonancia Magnética de Abdomen'],
        ];

        foreach ($examenes as $examen) {
            DB::table('examenes')->insert($examen + [
                'codigo' => null,
                'precio' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
