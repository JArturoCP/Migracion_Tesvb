<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$file = 'resources/views/actividades_complementarias/jefatura/imprimir_constancias.blade.php';
$c = Illuminate\Support\Facades\Blade::compileString(file_get_contents($file));
file_put_contents('scratch/compiled_test.php', $c);
system('php -l scratch/compiled_test.php');
