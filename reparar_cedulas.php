<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

// ⚠️ CAMBIA ESTAS CÉDULAS POR LAS REALES DE FRANCISCO Y MÉDICO PRUEBA
// Si no las tienes, deja estas de prueba (11 dígitos para que se vean bien)
$reparaciones = [
    10 => '1700000010', // Francisco (reemplaza por su cédula real)
    11 => '1700000011', // Médico Prueba (reemplaza por su cédula real)
];

foreach ($reparaciones as $id => $cedula) {
    $u = User::find($id);
    if ($u) {
        // Forzamos el guardado para que el trait Encryptable encripte la cédula
        $u->cedula = $cedula;
        $u->save();
        echo "✅ {$u->name} reparado." . PHP_EOL;
        echo "   Cédula visible: {$u->cedula}" . PHP_EOL;
        echo "   Hash: " . substr($u->cedula_hash, 0, 12) . "..." . PHP_EOL;
    }
}
