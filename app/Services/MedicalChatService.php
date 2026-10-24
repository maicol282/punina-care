<?php

namespace App\Services;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MedicalChatService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://api.groq.com/openai/v1/chat/completions';
    protected string $model = 'openai/gpt-oss-120b';

    public function __construct()
    {
        $this->apiKey = config('services.groq.key', env('GROQ_API_KEY'));
    }

    /**
     * Anonimiza los datos sensibles de un paciente en un texto.
     */
    public function anonymize(string $text, Paciente $paciente): string
    {
        $replacements = [
            $paciente->nombre_completo => '[PACIENTE]',
            $paciente->nombre => '[PACIENTE]',
            $paciente->apellido => '[PACIENTE]',
            $paciente->cedula => '[CEDULA]',
            $paciente->email => '[EMAIL]',
            $paciente->telefono => '[TELEFONO]',
        ];

        foreach ($replacements as $search => $replace) {
            if (!empty($search)) {
                $text = str_ireplace($search, $replace, $text);
            }
        }

        return $text;
    }

    /**
     * Envía un mensaje al chat de IA con el historial completo.
     */
    public function chat(array $messages, string $systemPrompt): ?string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post($this->baseUrl, [
                'model' => $this->model,
                'messages' => array_merge([
                    ['role' => 'system', 'content' => $systemPrompt]
                ], $messages),
                'temperature' => 0.3,
                'max_tokens' => 2000,
            ]);

            if ($response->failed()) {
                Log::error('Groq Chat error: ' . $response->body());
                return null;
            }

            return $response->json('choices.0.message.content');
        } catch (\Exception $e) {
            Log::error('Groq Chat exception: ' . $e->getMessage());
            return null;
        }
    }
}