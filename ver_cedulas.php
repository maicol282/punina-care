<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

foreach (User::all() as $u) {
    echo "ID: {$u->id} | {$u->name}" . PHP_EOL;
    echo "  Cédula (desencriptada por trait): '{$u->cedula}'" . PHP_EOL;
    echo "  Cédula (raw en BD): '{$u->getRawOriginal('cedula')}'" . PHP_EOL;
    echo "  Hash guardado: {$u->cedula_hash}" . PHP_EOL;
    echo "---" . PHP_EOL;
}
