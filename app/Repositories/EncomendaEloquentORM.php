<?php

namespace App\Repositories;
use App\Models\Encomenda;

class EncomendaEloquentORM
{


    public function getAll(): array
    {
        return Encomenda::with(['itens.itemable'])
            ->get()
            ->toArray();
    }

    public function getById(int $id): array
    {
        return Encomenda::with(['itens.itemable'])
            ->find($id)
            ->toArray();
    }

    public function create(array $data): array
    {
        $encomenda = Encomenda::create($data);
        return $encomenda->toArray();
    }

    public function update(int $id, array $data): array
    {
        $encomenda = Encomenda::find($id);
        $encomenda->update($data);
        return $encomenda->toArray();
    }

    public function delete(int $id): array
    {
        $encomenda = Encomenda::find($id);
        $encomenda->delete();
        return $encomenda->toArray();
    }
}
