<?php

use App\Services\EncomendaService;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Item;
use App\Models\Casaco;

it('can create an encomenda with items', function () {
    $cliente = Cliente::factory()->create();

    $service = new EncomendaService(
        app(\App\Repositories\ClientEloquenteORM::class),
        app(\App\Repositories\EncomendaEloquentORM::class),
        app(\App\Repositories\ItemEloquentORM::class),
        app(\App\Repositories\CasacoEloquenteORM::class)
    );

    $data = [
        'cliente_id' => $cliente->id,
        'numero' => 'ENC-001',
        'data' => '2025-01-01',
        'status' => 'Pendente',
        'observacao' => 'Test encomenda',
        'itens' => [
            [
                'tipo' => 'casaco',
                'dados' => [
                    'modelo' => 'Test Modelo',
                    'lapela' => 'Test Lapela',
                    'bolsos' => 'Test Bolsos',
                    'forro' => 'Test Forro',
                    'botao' => 'Test Botao',
                    'manga' => 'Test Manga',
                    'costas' => 'Test Costas',
                    'acabamento' => 'Test Acabamento',
                    'status' => 'Pendente',
                ],
                'quantidade' => 2,
                'descricao' => 'Test description',
            ],
        ],
    ];

    $encomenda = $service->encomenda($data);

    expect($encomenda)->toBeInstanceOf(Encomenda::class);
    expect($encomenda->cliente_id)->toBe($cliente->id);
    expect($encomenda->numero)->toBe('ENC-001');
    expect($encomenda->status)->toBe('Pendente');
    expect($encomenda->itens)->toHaveCount(1);

    $item = $encomenda->itens->first();
    expect($item)->toBeInstanceOf(Item::class);
    expect($item->quantidade)->toBe(2);
    expect($item->descricao)->toBe('Test description');
    expect($item->itemable)->toBeInstanceOf(Casaco::class);
    expect($item->itemable->modelo)->toBe('Test Modelo');
});

it('throws exception for unsupported item type', function () {
    $cliente = Cliente::factory()->create();

    $service = new EncomendaService(
        app(\App\Repositories\ClientEloquenteORM::class),
        app(\App\Repositories\EncomendaEloquentORM::class),
        app(\App\Repositories\ItemEloquentORM::class),
        app(\App\Repositories\CasacoEloquenteORM::class)
    );

    $data = [
        'cliente_id' => $cliente->id,
        'itens' => [
            [
                'tipo' => 'invalid_type',
                'dados' => [],
            ],
        ],
    ];

    expect(fn() => $service->encomenda($data))->toThrow(\Exception::class, "Tipo de item 'invalid_type' não suportado");
});
