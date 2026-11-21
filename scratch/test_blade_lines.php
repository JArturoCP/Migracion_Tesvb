<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$file = 'resources/views/actividades_complementarias/jefatura/imprimir_constancias.blade.php';
$compiled = Illuminate\Support\Facades\Blade::compileString(file_get_contents($file));
$lines = explode("\n", $compiled);
foreach ($lines as $i => $line) {
    echo ($i + 1) . ": " . $line . "\n";
}
