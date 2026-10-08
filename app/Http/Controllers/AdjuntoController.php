<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Adjunto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class AdjuntoController extends Controller
{
    public function store(Request $request, HistorialClinico $historial): RedirectResponse
    {
        $request->validate([
            'archivo' => 'required|file|max:20480',
            'tipo' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:500'
        ]);

        try {
            $file = $request->file('archivo');
            $contenido = file_get_contents($file->getRealPath());
            $hash = hash('sha256', $contenido);
            $contenidoEncriptado = Crypt::encryptString($contenido);
            
            $nombre = Str::uuid() . '_' . time() . '.enc';
            $ruta = 'adjuntos/' . $nombre;
            
            if (!Storage::disk('private')->exists('adjuntos')) {
                Storage::disk('private')->makeDirectory('adjuntos');
            }
            
            Storage::disk('private')->put($ruta, $contenidoEncriptado);
            
            $adjunto = $historial->adjuntos()->create([
                'nombre_original' => $file->getClientOriginalName(),
                'ruta' => $ruta,
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'tamano' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'hash_integridad' => $hash,
                'encrypt_version' => '1.0'
            ]);

            $usuario = auth()->guard()->user();
            $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';

            Log::info("Archivo subido y encriptado", [
                'adjunto_id' => $adjunto->id,
                'paciente_id' => $historial->paciente_id,
                'usuario' => $nombreUsuario
            ]);

            return redirect()->route('historial.show', $historial)
                ->with('success', 'Archivo subido correctamente');

        } catch (\Exception $e) {
            Log::error("Error subiendo archivo: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al subir el archivo: ' . $e->getMessage());
        }
    }

    public function download(Adjunto $adjunto)
    {
        try {
            $contenidoEncriptado = Storage::disk('private')->get($adjunto->ruta);
            $contenido = Crypt::decryptString($contenidoEncriptado);
            
            $hash = hash('sha256', $contenido);
            if ($hash !== $adjunto->hash_integridad) {
                $usuario = auth()->guard()->user();
                $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';
                
                Log::warning("Integridad comprometida en archivo", [
                    'adjunto_id' => $adjunto->id,
                    'usuario' => $nombreUsuario
                ]);
                abort(403, 'La integridad del archivo no pudo ser verificada.');
            }
            
            $usuario = auth()->guard()->user();
            $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';
            
            Log::info("Archivo descargado", [
                'adjunto_id' => $adjunto->id,
                'usuario' => $nombreUsuario
            ]);

            return response($contenido)
                ->header('Content-Type', $adjunto->mime_type)
                ->header('Content-Disposition', 'attachment; filename="' . $adjunto->nombre_original . '"')
                ->header('X-Content-Type-Options', 'nosniff');

        } catch (\Exception $e) {
            Log::error("Error descargando archivo: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al descargar el archivo.');
        }
    }

    public function destroy(Adjunto $adjunto): RedirectResponse
    {
        try {
            if (Storage::disk('private')->exists($adjunto->ruta)) {
                Storage::disk('private')->delete($adjunto->ruta);
            }
            
            $historialId = $adjunto->historial_clinico_id;
            $adjunto->delete();
            
            $usuario = auth()->guard()->user();
            $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';
            
            Log::info("Archivo eliminado", [
                'adjunto_id' => $adjunto->id,
                'usuario' => $nombreUsuario
            ]);

            return redirect()->route('historial.show', $historialId)
                ->with('success', 'Archivo eliminado correctamente');

        } catch (\Exception $e) {
            Log::error("Error eliminando archivo: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el archivo.');
        }
    }
}