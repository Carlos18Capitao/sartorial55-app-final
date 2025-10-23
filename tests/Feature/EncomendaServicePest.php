<?php

use App\Services\EncomendaService;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Item;
use App\Models\Casaco;
use App\Models\Photo;

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
                'photos' => [
                    [
                        'filename' => 'item_photo1.jpg',
                        'mime_type' => 'image/jpeg',
                        'size' => 204800,
                    ],
                    [
                        'filename' => 'item_photo2.jpg',
                        'mime_type' => 'image/jpeg',
                        'size' => 102400,
                    ],
                ],
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

    // Check photos
    expect($item->photos)->toHaveCount(2);
    expect($item->photos->first())->toBeInstanceOf(Photo::class);
    expect($item->photos->first()->filename)->toBe('item_photo1.jpg');
    expect($item->photos->first()->mime_type)->toBe('image/jpeg');
    expect($item->photos->first()->size)->toBe(204800);
    expect($item->photos->first()->photoable_type)->toBe(Item::class);
    expect($item->photos->first()->photoable_id)->toBe($item->id);
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
