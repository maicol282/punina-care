<?php

namespace App\Console\Commands;

use App\Models\EstudioAdjunto;
use App\Models\Adjunto;
use App\Models\HistorialClinico;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class MigrarAdjuntosEncriptados extends Command
{
    protected $signature = 'adjuntos:migrar';
    protected $description = 'Migra archivos del sistema antiguo al sistema encriptado';

    public function handle()
    {
        $antiguos = EstudioAdjunto::all();
        $migrados = 0;
        $errores = 0;

        foreach ($antiguos as $antiguo) {
            try {
                // Verificar que el archivo físico existe
                $rutaPublica = storage_path('app/public/' . $antiguo->ruta);
                
                if (!file_exists($rutaPublica)) {
                    $this->warn("⚠️ Archivo no encontrado: {$antiguo->ruta}");
                    $errores++;
                    continue;
                }

                // Leer el contenido
                $contenido = file_get_contents($rutaPublica);
                
                // Calcular hash
                $hash = hash('sha256', $contenido);
                
                // Encriptar
                $contenidoEncriptado = Crypt::encryptString($contenido);
                
                // Generar nombre único
                $nombre = Str::uuid() . '_' . time() . '.enc';
                $rutaNueva = 'adjuntos/' . $nombre;
                
                // Guardar encriptado
                Storage::disk('private')->put($rutaNueva, $contenidoEncriptado);
                
                // Crear registro en la nueva tabla
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
                
                $this->info("✅ Migrado: {$antiguo->nombre_original}");
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