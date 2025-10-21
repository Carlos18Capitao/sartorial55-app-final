<?php

namespace App\Repositories;

use App\Models\Item;

class ItemEloquentORM
{
    public function getAll(): array
    {
        return Item::all()->toArray();
    }

    public function getById(int $id): array
    {
        return Item::find($id)->toArray();
    }

    public function create(array $data): array
    {
        $item = Item::create($data);
        return $item->toArray();
    }

    public function update(int $id, array $data): array
    {
        $item = Item::find($id);
        $item->update($data);
        return $item->toArray();
    }

    public function delete(int $id): array
    {
        $item = Item::find($id);
        $item->delete();
        return $item->toArray();
    }
}
