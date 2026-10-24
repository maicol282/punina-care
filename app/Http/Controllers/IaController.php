<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Services\MedicalChatService;
use Illuminate\Http\Request;

class IaController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        return view('ia.index', compact('pacientes'));
    }

    /**
     * Endpoint del chat (AJAX).
     */
    public function chat(Request $request, MedicalChatService $chatService)
    {
        $request->validate([
            'messages' => 'required|array',
            'messages.*.role' => 'required|in:user,assistant',
            'messages.*.content' => 'required|string',
            'paciente_id' => 'nullable|exists:pacientes,id',
        ]);

        $systemPrompt = "Eres un asistente médico experto. Ayudas a doctores con diagnósticos, tratamientos y planes de salud. 
        Responde de forma clara, profesional y concisa. No inventes información que no se te proporcione. 
        Si el usuario te da datos de un paciente, estos ya han sido anonimizados por seguridad.";

        $messages = $request->messages;

        // Si se adjuntó un paciente, anonimizamos su contexto y lo añadimos
        if ($request->filled('paciente_id')) {
            $paciente = Paciente::findOrFail($request->paciente_id);
            $contexto = "Datos clínicos del paciente:\n";
            $contexto .= "- Edad: {$paciente->edad} años\n";
            $contexto .= "- Género: " . ($paciente->genero == 'M' ? 'Masculino' : ($paciente->genero == 'F' ? 'Femenino' : 'Otro')) . "\n";
            $contexto .= "- Alergias: " . ($paciente->alergias ?: 'Ninguna registrada') . "\n";
            
            // Anonimizamos por si acaso hay datos sensibles en el texto
            $contexto = $chatService->anonymize($contexto, $paciente);
            
            // Añadimos el contexto como un mensaje del sistema adicional (o lo inyectamos en el primer mensaje del usuario)
            $messages[0]['content'] = "Contexto del paciente:\n" . $contexto . "\n\n" . $messages[0]['content'];
        }

        $respuesta = $chatService->chat($messages, $systemPrompt);

        if (!$respuesta) {
            return response()->json(['error' => 'No se pudo obtener respuesta de la IA. Intenta de nuevo.'], 500);
        }

        return response()->json(['response' => $respuesta]);
    }
}