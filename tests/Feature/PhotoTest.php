<?php

use App\Models\Photo;
use App\Models\Cliente;
use App\Models\Item;

test('photo belongs to cliente', function () {
    $cliente = Cliente::factory()->create();
    $photo = Photo::create([
        'path' => 'storage/photos/clientes/' . $cliente->id . '/profile.jpg',
        'filename' => 'profile.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 102400,
        'photoable_type' => Cliente::class,
        'photoable_id' => $cliente->id,
    ]);

    expect($photo->photoable)->toBeInstanceOf(Cliente::class);
    expect($photo->photoable->id)->toBe($cliente->id);
});

test('photo belongs to item', function () {
    $item = Item::factory()->create();
    $photo = Photo::create([
        'path' => 'storage/photos/items/' . $item->id . '/item.jpg',
        'filename' => 'item.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 51200,
        'photoable_type' => Item::class,
        'photoable_id' => $item->id,
    ]);

    expect($photo->photoable)->toBeInstanceOf(Item::class);
    expect($photo->photoable->id)->toBe($item->id);
});

test('cliente has many photos', function () {
    $cliente = Cliente::factory()->create();
    $photo1 = Photo::create([
        'path' => 'storage/photos/clientes/' . $cliente->id . '/profile1.jpg',
        'filename' => 'profile1.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 102400,
        'photoable_type' => Cliente::class,
        'photoable_id' => $cliente->id,
    ]);
    $photo2 = Photo::create([
        'path' => 'storage/photos/clientes/' . $cliente->id . '/profile2.jpg',
        'filename' => 'profile2.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 102400,
        'photoable_type' => Cliente::class,
        'photoable_id' => $cliente->id,
    ]);

    expect($cliente->photos)->toHaveCount(2);
    expect($cliente->photos->pluck('id'))->toContain($photo1->id, $photo2->id);
});

test('item has many photos', function () {
    $item = Item::factory()->create();
    $photo1 = Photo::create([
        'path' => 'storage/photos/items/' . $item->id . '/item1.jpg',
        'filename' => 'item1.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 51200,
        'photoable_type' => Item::class,
        'photoable_id' => $item->id,
    ]);
    $photo2 = Photo::create([
        'path' => 'storage/photos/items/' . $item->id . '/item2.jpg',
        'filename' => 'item2.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 51200,
        'photoable_type' => Item::class,
        'photoable_id' => $item->id,
    ]);

    expect($item->photos)->toHaveCount(2);
    expect($item->photos->pluck('id'))->toContain($photo1->id, $photo2->id);
});
