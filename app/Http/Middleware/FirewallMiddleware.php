<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FirewallMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        if ($this->isIpBlocked($ip)) {
            Log::warning("IP bloqueada intentando acceder", [
                'ip' => $ip,
                'ruta' => $request->path()
            ]);
            abort(403, 'Acceso denegado. IP bloqueada.');
        }

        if (!$this->checkRateLimit($ip)) {
            Log::warning("Rate limit excedido", [
                'ip' => $ip,
                'ruta' => $request->path()
            ]);
            abort(429, 'Demasiadas solicitudes. Espere un momento.');
        }

        if ($request->isMethod('post') || $request->isMethod('put')) {
            $this->detectAttackPatterns($request, $ip);
        }

        return $next($request);
    }

    protected function isIpBlocked(string $ip): bool
    {
        return Cache::has("firewall:blocked:{$ip}");
    }

    protected function checkRateLimit(string $ip): bool
    {
        $key = "firewall:requests:{$ip}";
        $count = Cache::get($key, 0);
        
        $limit = auth()->guard()->check() ? 120 : 60;
        
        if ($count >= $limit) {
            return false;
        }
        
        Cache::increment($key);
        
        if ($count === 0) {
            Cache::put($key, 1, now()->addMinute());
        }
        
        return true;
    }

    protected function detectAttackPatterns(Request $request, string $ip): void
    {
        $input = $request->all();
        
        $sqlPatterns = ['union', 'select', 'insert', 'update', 'delete', 'drop', 'alter', 'create', '--', ';'];
        
        foreach ($input as $field => $value) {
            if (is_string($value)) {
                foreach ($sqlPatterns as $pattern) {
                    if (stripos($value, $pattern) !== false) {
                        Log::warning("Posible inyeccion SQL detectada", [
                            'ip' => $ip,
                            'campo' => $field,
                            'patron' => $pattern
                        ]);
                        Cache::put("firewall:blocked:{$ip}", 'Posible inyeccion SQL', now()->addMinutes(30));
                        abort(403, 'Solicitud bloqueada por seguridad');
                    }
                }
            }
        }

        $xssPatterns = ['<script', 'javascript:', 'onerror', 'onload', 'onclick', 'alert(', 'document.cookie'];
        
        foreach ($input as $field => $value) {
            if (is_string($value)) {
                foreach ($xssPatterns as $pattern) {
                    if (stripos($value, $pattern) !== false) {
                        Log::warning("Posible XSS detectado", [
                            'ip' => $ip,
                            'campo' => $field,
                            'patron' => $pattern
                        ]);
                        $request->merge([$field => strip_tags($value)]);
                    }
                }
            }
        }
    }
}