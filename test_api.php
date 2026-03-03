<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test the API response
$encomendas = \App\Services\EncomendaService::class;
$service = new \App\Services\EncomendaService();
$result = $service->getAllAsDTO(15);

echo "Result type: " . gettype($result) . "\n";
echo "Keys: " . implode(', ', array_keys($result)) . "\n";
echo "data type: " . gettype($result['data']) . "\n";
echo "data[0] type: " . (isset($result['data'][0]) ? gettype($result['data'][0]) : 'not set') . "\n";

if (isset($result['data'][0])) {
    echo "data[0] keys: " . implode(', ', array_keys($result['data'][0])) . "\n";
}

echo "\nFull result:\n";
echo json_encode($result, JSON_PRETTY_PRINT);

