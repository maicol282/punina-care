<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    use HasFactory, Encryptable;

    protected $table = 'historial_clinicos';

    protected $encryptable = [
        'motivo_consulta',
        'diagnostico',
        'tratamiento',
        'medicamentos',
        'observaciones',
        'hospitalizaciones',
        'cardiovasculares',
        'pulmonales',
        'digestivos',
        'diabetes',
        'renales',
        'quirurgicos',
        'transfusiones',
        'alergias_patologicas',
        'otros_patologicos',
        'inmunizaciones',
        'antecedentes_familiares',
        'otros_no_patologicos',
        'antecedentes_personales',
        'cabeza',
        'cuello',
        'torax',
        'abdomen',
        'extremidades',
        'neurologico',
        'estado_mental',
        'piel',
        'columna',
        'pelvis',
        'axilas',
        'mamas',
        'laboratorio',
        'estudio_imagen',
        'otros_exploracion',
        'enfermedad_actual',
        'exploracion_fisica',
        'recomendaciones',
    ];

    protected $fillable = [
        'paciente_id',
        'fecha_consulta',
        'motivo_consulta',
        'diagnostico',
        'tratamiento',
        'medicamentos',
        'presion_arterial',
        'temperatura',
        'peso',
        'altura',
        'masa_corporal',
        'observaciones',
        'doctor',
        'cie10_code',
        'cie10_presuntivo',
        'cie10_definitivo',
        // Antecedentes Patológicos
        'hospitalizaciones',
        'cardiovasculares',
        'pulmonales',
        'digestivos',
        'diabetes',
        'renales',
        'quirurgicos',
        'transfusiones',
        'alergias_patologicas',
        'otros_patologicos',
        // Antecedentes No Patológicos
        'alcohol',
        'tabaquismo',
        'drogas',
        'inmunizaciones',
        'antecedentes_familiares',
        'otros_no_patologicos',
        'antecedentes_personales',
        // Antecedentes Familiares (NUEVO)
        'familiar_hipertension',
        'familiar_diabetes',
        'familiar_cardiopatias',
        'familiar_cancer',
        'familiar_obesidad',
        'familiar_dislipidemia',
        'familiar_enfermedad_renal',
        'familiar_enfermedad_tiroidea',
        'familiar_enfermedad_mental',
        'familiar_tuberculosis',
        'familiar_alcoholismo',
        'familiar_otras',
        'familiares_no_refiere',
        // Gineco Obstétricos
        'menarquia',
        'ritmo',
        'fmu',
        'gestas',
        'partos',
        'abortos',
        'cesareas',
        'hijos_vivos',
        'num_parejas_sexuales',
        'menopausia',
        'usa_anticonceptivos',
        'cuales_anticonceptivos',
        // Signos Vitales
        'ta_derecho',
        'ta_izquierdo',
        'fc',
        'sat',
        'fr',
        'glagow',
        // 'glicemia',  // ELIMINADO - Reemplazado por masa_corporal
        'hb',
        // Exploración por Regiones (con tipos)
        'cabeza',
        'cabeza_tipo',
        'cuello',
        'cuello_tipo',
        'torax',
        'torax_tipo',
        'abdomen',
        'abdomen_tipo',
        'extremidades',
        'extremidades_tipo',
        'neurologico',
        'neurologico_tipo',
        'estado_mental',
        // Nuevos campos exploración (NUEVO)
        'piel',
        'piel_tipo',
        'columna',
        'columna_tipo',
        'pelvis',
        'pelvis_tipo',
        'axilas',
        'axilas_tipo',
        'mamas',
        'mamas_tipo',
        // Estudios
        'laboratorio',
        'estudio_imagen',
        'otros_exploracion',
        'enfermedad_actual',
        'exploracion_fisica',
        'recomendaciones',
        'sist_cardiovascular', 'sist_cardiovascular_obs',
        'sist_respiratorio', 'sist_respiratorio_obs',
        'sist_digestivo', 'sist_digestivo_obs',
        'sist_renal', 'sist_renal_obs',
        'sist_neurologico', 'sist_neurologico_obs',
        'sist_musculoesqueletico', 'sist_musculoesqueletico_obs',
        'sist_endocrino', 'sist_endocrino_obs',
        'sist_hematologico', 'sist_hematologico_obs',
        'sist_linfatico', 'sist_linfatico_obs',
        'sist_genitourinario', 'sist_genitourinario_obs',
        'sist_piel', 'sist_piel_obs',
        'sist_oftalmologico', 'sist_oftalmologico_obs',
        'sist_orl', 'sist_orl_obs',
        'sist_psiquiatrico', 'sist_psiquiatrico_obs',
        'observaciones_sistemas',
    ];

    protected $casts = [
        'fecha_consulta' => 'date',
        'fmu' => 'date',
        'usa_anticonceptivos' => 'boolean',
        'temperatura' => 'decimal:2',
        'peso' => 'decimal:2',
        'altura' => 'decimal:2',
        'masa_corporal' => 'decimal:2',
        'hijos_vivos' => 'integer',
        'familiares_no_refiere' => 'boolean',
        'familiar_hipertension' => 'boolean',
        'familiar_diabetes' => 'boolean',
        'familiar_cardiopatias' => 'boolean',
        'familiar_cancer' => 'boolean',
        'familiar_obesidad' => 'boolean',
        'familiar_dislipidemia' => 'boolean',
        'familiar_enfermedad_renal' => 'boolean',
        'familiar_enfermedad_tiroidea' => 'boolean',
        'familiar_enfermedad_mental' => 'boolean',
        'familiar_tuberculosis' => 'boolean',
        'familiar_alcoholismo' => 'boolean',
        'familiar_otras' => 'boolean',
        'sist_cardiovascular' => 'string',
        'sist_respiratorio' => 'string',
        'sist_digestivo' => 'string',
        'sist_renal' => 'string',
        'sist_neurologico' => 'string',
        'sist_musculoesqueletico' => 'string',
        'sist_endocrino' => 'string',
        'sist_hematologico' => 'string',
        'sist_linfatico' => 'string',
        'sist_genitourinario' => 'string',
        'sist_piel' => 'string',
        'sist_oftalmologico' => 'string',
        'sist_orl' => 'string',
        'sist_psiquiatrico' => 'string',
    ];

    public function setAttribute($key, $value)
    {
        if (is_string($value) && ($value === '' || $value === 'No aplica' || $value === 'Ninguna' || $value === 'Ninguno')) {
            $value = null;
        }
        parent::setAttribute($key, $value);
    }

    // ========== RELACIONES ==========

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    public function adjuntos()
    {
        return $this->hasMany(Adjunto::class);
    }

    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class)->orderBy('orden');
    }
    public function reposos()
    {
    return $this->hasMany(Reposo::class);
    }

   public function estudiosAdjuntos()
{
    return $this->hasMany(EstudioAdjunto::class, 'historial_clinico_id');
}
public function certificadosMedicos()
{
    return $this->hasMany(CertificadoMedico::class);
}

    // ========== ATRIBUTOS PERSONALIZADOS ==========

    public function getImcAttribute()
    {
        if ($this->peso && $this->altura && $this->altura > 0) {
            return round($this->peso / ($this->altura * $this->altura), 2);
        }
        return null;
    }

    // ========== SCOPES PARA DIAGNÓSTICOS ==========

    public function getDiagnosticosPresuntivosAttribute()
    {
        return $this->diagnosticos->where('tipo', 'PRE');
    }

    public function getDiagnosticosDefinitivosAttribute()
    {
        return $this->diagnosticos->where('tipo', 'DEF');
    }

    // ========== SCOPES PARA EXPLORACIÓN ==========

    public function getExploracionCompletaAttribute()
    {
        $campos = [
            'cabeza' => 'Cabeza',
            'cuello' => 'Cuello',
            'torax' => 'Tórax',
            'abdomen' => 'Abdomen',
            'extremidades' => 'Extremidades',
            'neurologico' => 'Neurológico',
            'piel' => 'Piel',
            'columna' => 'Columna',
            'pelvis' => 'Pelvis',
            'axilas' => 'Axilas',
            'mamas' => 'Mamas'
        ];

        $resultado = [];
        foreach ($campos as $campo => $label) {
            $tipoCampo = $campo . '_tipo';
            $valor = $this->$campo;
            $tipo = $this->$tipoCampo ?? 'SP';
            
            if ($valor) {
                $resultado[] = "{$label} ({$tipo}): {$valor}";
            }
        }
        
        return implode("\n", $resultado);
    }

    // ========== SCOPES PARA ANTECEDENTES FAMILIARES ==========

    public function getAntecedentesFamiliaresListaAttribute()
    {
        if ($this->familiares_no_refiere) {
            return 'No refiere antecedentes familiares';
        }

        $enfermedades = [
            'familiar_hipertension' => 'Hipertensión Arterial',
            'familiar_diabetes' => 'Diabetes Mellitus',
            'familiar_cardiopatias' => 'Cardiopatías',
            'familiar_cancer' => 'Cáncer',
            'familiar_obesidad' => 'Obesidad',
            'familiar_dislipidemia' => 'Dislipidemia',
            'familiar_enfermedad_renal' => 'Enfermedad Renal',
            'familiar_enfermedad_tiroidea' => 'Enfermedad Tiroidea',
            'familiar_enfermedad_mental' => 'Enfermedad Mental',
            'familiar_tuberculosis' => 'Tuberculosis',
            'familiar_alcoholismo' => 'Alcoholismo',
            'familiar_otras' => 'Otras'
        ];

        $presentes = [];
        foreach ($enfermedades as $campo => $label) {
            if ($this->$campo) {
                $presentes[] = $label;
            }
        }

        if (empty($presentes)) {
            return 'No refiere antecedentes familiares';
        }

        return implode(', ', $presentes);
    }
}