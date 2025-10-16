<?php

namespace App\Repositories;

use App\Repositories\Contracts\PercistORM;

use App\Models\Cliente as Client;
use stdClass;

class ClientEloquenteORM implements PercistORM
{
    public function getAll(string $filter = null): array
    {
        $clients = Client::with(['encomendas.itens.itemable'])
            ->get()
            ->filter(function ($client) {
                return $client->encomendas->isNotEmpty();
            })
            ->map(function ($client) {
                $client->encomendas->map(function ($encomenda) {
                    $encomenda->itens->map(function ($item) {
                        $item->quantidade = (int) $item->quantidade; // ou outra lógica
                        return $item;
                    });
                    return $encomenda;
                });
                return $client;
            })
            ->toArray();
        return $clients;
    }
    public function findOne(string $id): stdClass|null
    {
        $client = Client::find($id);
        return $client ? (object) $client->toArray() : null;
    }
    public function delete(string $id): void
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
        }
    }
    public function new(array $dto): stdClass
    {
        $client = new Client();
        $client->fill((array) $dto);
        $client->save();
        return (object) $client->toArray();
    }
    public function update(array $dto): stdClass|null
    {
        $client = Client::find($dto['id'] ?? null);
        if ($client) {
            $client->fill((array) $dto);
            $client->save();
            return (object) $client->toArray();
        }
        return null;
    }
    public function updateStatus(string $id, array $status): void
    {
        $client = Client::find($id);
        if ($client) {
            $client->status = $status;
            $client->save();
        }
    }
}
