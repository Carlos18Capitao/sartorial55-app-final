<?php

use App\Models\Casaco;
use App\Repositories\CasacoEloquenteORM;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a new casaco', function () {
    $repo = new CasacoEloquenteORM();
    $data = [
        'modelo' => 'Modelo A',
        'lapela' => 'Lapela B',
        'bolsos' => '2 bolsos',
        'forro' => 'Forro C',
        'botao' => 'Botão D',
        'manga' => 'Manga E',
        'costas' => 'Costas F',
        'acabamento' => 'Acabamento G',
        'status' => 'ativo'
    ];

    $casaco = $repo->newItem($data);

    expect($casaco)->toBeInstanceOf(Casaco::class);
    expect($casaco->modelo)->toBe('Modelo A');
});

it('can get all casacos', function () {
    Casaco::factory()->count(3)->create();
    $repo = new CasacoEloquenteORM();

    $casacos = $repo->getAllItems();

    expect($casacos)->toBeArray();
    expect(count($casacos))->toBe(3);
});

it('can find one casaco by id', function () {
    $casaco = Casaco::factory()->create();
    $repo = new CasacoEloquenteORM();

    $found = $repo->findOne($casaco->id);

    expect($found)->toBeInstanceOf(Casaco::class);
    expect($found->id)->toBe($casaco->id);
});

it('throws exception when casaco not found', function () {
    $repo = new CasacoEloquenteORM();

    expect(fn() => $repo->findOne('999'))->toThrow(\Exception::class);
});

it('can update a casaco', function () {
    $casaco = Casaco::factory()->create();
    $repo = new CasacoEloquenteORM();
    $updateData = ['modelo' => 'Updated Modelo'];

    $updated = $repo->update($casaco->id, $updateData);

    expect($updated)->toBeInstanceOf(Casaco::class);
    expect($updated->modelo)->toBe('Updated Modelo');
});

it('throws exception when updating non-existent casaco', function () {
    $repo = new CasacoEloquenteORM();

    expect(fn() => $repo->update('999', ['modelo' => 'Test']))->toThrow(\Exception::class);
});

it('can update casaco status', function () {
    $casaco = Casaco::factory()->create();
    $repo = new CasacoEloquenteORM();

    $result = $repo->updateStatus($casaco->id, ['status' => 'inativo']);

    expect($result)->toBeTrue();
    $casaco->refresh();
    expect($casaco->status)->toBe('inativo');
});

it('can delete a casaco', function () {
    $casaco = Casaco::factory()->create();
    $repo = new CasacoEloquenteORM();

    $repo->delete($casaco->id);

    expect(Casaco::find($casaco->id))->toBeNull();
});

it('can get casaco by id', function () {
    $casaco = Casaco::factory()->create();
    $repo = new CasacoEloquenteORM();

    $found = $repo->getById($casaco->id);

    expect($found)->toBeInstanceOf(Casaco::class);
    expect($found->id)->toBe($casaco->id);
});

it('throws exception when getting non-existent casaco by id', function () {
    $repo = new CasacoEloquenteORM();

    expect(fn() => $repo->getById('999'))->toThrow(\Exception::class);
});
