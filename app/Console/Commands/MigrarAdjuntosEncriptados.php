<?php

namespace App\Console\Commands;

use App\Models\EstudioAdjunto;
use App\Models\Adjunto;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

#[Signature('adjuntos:migrar')]
#[Description('Migra archivos del sistema antiguo al sistema encriptado')]
class MigrarAdjuntosEncriptados extends Command
{
    public function handle()
    {
        $antiguos = EstudioAdjunto::all();
        $migrados = 0;
        $errores = 0;

        $this->info("Iniciando migración de {$antiguos->count()} archivos...");
        $this->newLine();

        foreach ($antiguos as $antiguo) {
            try {
                $rutaPublica = storage_path('app/public/' . $antiguo->ruta);
                
                if (!file_exists($rutaPublica)) {
                    $this->warn("⚠️ Archivo no encontrado: {$antiguo->ruta}");
                    $errores++;
                    continue;
                }

                $contenido = file_get_contents($rutaPublica);
                $hash = hash('sha256', $contenido);
                $contenidoEncriptado = Crypt::encryptString($contenido);
                
                $nombre = Str::uuid() . '_' . time() . '.enc';
                $rutaNueva = 'adjuntos/' . $nombre;
                
                Storage::disk('private')->put($rutaNueva, $contenidoEncriptado);
                
                Adjunto::create([
                    'historial_clinico_id' => $antiguo->historial_clinico_id,
                    'nombre_original' => $antiguo->nombre_original,
                    'ruta' => $rutaNueva,
                    'tipo' => $antiguo->categoria ?? 'Otros',
                    'descripcion' => $antiguo->descripcion,
                    'tamano' => $antiguo->tamano,
                    'mime_type' => $antiguo->mime_type,
                    'hash_integridad' => $hash,
                    'encrypt_version' => '1.0'
                ]);
                
                $this->info("✅ Migrado: {$antiguo->nombre_original} ({$antiguo->tamano} bytes)");
                $migrados++;
                
            } catch (\Exception $e) {
                $this->error("❌ Error con {$antiguo->nombre_original}: " . $e->getMessage());
                $errores++;
            }
        }

        $this->newLine();
        $this->info("=== RESULTADO ===");
        $this->info("Migrados: $migrados");
        $this->info("Errores: $errores");
        
        return Command::SUCCESS;
    }
}
