<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test pagination
$clientes = App\Models\Cliente::with(['user', 'encomendas.itens.medida', 'medidas'])->paginate(2);

$clientes->getCollection()->transform(function ($cliente) {
    return App\DTOs\Responses\ClienteDTO::fromModel($cliente)->toArray();
});

// Debug the result
echo "Collection type: " . get_class($clientes) . "\n";
echo "First item type: " . gettype($clientes->items()[0]) . "\n";
if (isset($clientes->items()[0]) && is_array($clientes->items()[0])) {
    echo "First item keys: " . implode(', ', array_keys($clientes->items()[0])) . "\n";
}
echo json_encode($clientes, JSON_PRETTY_PRINT);

