<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$usuarios = User::all();
foreach ($usuarios as $u) {
    if ($u->cedula && !$u->cedula_hash) {
        $u->cedula = $u->cedula; // Forzamos el mutador
        $u->save();
        echo "✅ Hash generado para: " . $u->name . PHP_EOL;
    } else {
        echo "⚠  " . $u->name . " ya tiene hash o no tiene cédula." . PHP_EOL;
    }
}
