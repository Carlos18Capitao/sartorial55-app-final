<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Cliente;
use App\DTOs\Responses\ClienteDTO;

$cliente = Cliente::with(['user', 'encomendas', 'medidas'])->first();

if (!$cliente) {
    echo "No cliente found\n";
    exit;
}

$dto = ClienteDTO::fromModel($cliente);
$array = $dto->toArray();

echo json_encode($array, JSON_PRETTY_PRINT);

