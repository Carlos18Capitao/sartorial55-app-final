<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Cliente;
use App\DTOs\Responses\ClienteDTO;

$clientes = Cliente::with(['user', 'encomendas', 'medidas'])->paginate(15);

$clientes->getCollection()->transform(function ($cliente) {
    return ClienteDTO::fromModel($cliente);
});

$response = [
    'success' => true,
    'data' => $clientes,
];

echo json_encode($response, JSON_PRETTY_PRINT);

