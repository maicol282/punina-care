# Evaluación de Impacto (EIPD) - Uso de IA en Punina Care

**Responsable:** Maicol (Desarrollador)
**Fecha:** $(date +%Y-%m-%d)

## 1. Descripción del Tratamiento con IA
El sistema utiliza la API de Groq (modelo Llama 3) para generar sugerencias de diagnóstico y planes de salud. Los datos enviados son anonimizados (sin nombre, cédula ni email) antes de salir del servidor.

## 2. Base Legal
Consentimiento informado del paciente (documento físico firmado) y el interés legítimo en la mejora del servicio médico.

## 3. Evaluación de Riesgos
- **Riesgo de sesgo:** Bajo (la IA es de apoyo, no decide).
- **Riesgo de privacidad:** Bajo (anonimización implementada).
- **Riesgo de error:** Medio (el médico revisa y firma).

## 4. Medidas de Mitigación
- El médico es el único que puede validar la sugerencia de la IA.
- La API Key está protegida en el servidor.
- Los datos se envían anonimizados.

## 5. Conclusión
El riesgo es aceptable y se han implementado medidas técnicas para proteger los datos.
