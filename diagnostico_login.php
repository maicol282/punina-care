<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$cedulaPrueba = '1700000001';
$hashEsperado = hash('sha256', $cedulaPrueba);

echo "🔍 Cédula de prueba: {$cedulaPrueba}" . PHP_EOL;
echo "🔍 Hash esperado: {$hashEsperado}" . PHP_EOL;
echo "---" . PHP_EOL;

foreach (User::all() as $u) {
    echo "ID {$u->id} | {$u->name}" . PHP_EOL;
    echo "  Cédula guardada: " . ($u->cedula ?: 'NULL') . PHP_EOL;
    echo "  Hash guardado:   " . ($u->cedula_hash ?: 'NULL') . PHP_EOL;
    echo "  ¿Coincide con {$cedulaPrueba}? " . ($u->cedula_hash === $hashEsperado ? '✅ SÍ' : '❌ NO') . PHP_EOL;
    echo "---" . PHP_EOL;
}
