<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Contraseña segura para probar
$nuevaPassword = Hash::make('PuninaCare2026!');

foreach (User::all() as $u) {
    $u->password = $nuevaPassword;
    $u->save();
    echo "✅ Contraseña reseteada para: {$u->name} (Cédula: {$u->cedula})" . PHP_EOL;
}

echo "🔑 Usa esta contraseña para todos: PuninaCare2026!" . PHP_EOL;
