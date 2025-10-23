<?php

namespace App\Repositories;

use App\Repositories\Contracts\PercistORM;

use App\Models\Cliente as Client;
use App\Models\Photo;
use stdClass;

class ClientEloquenteORM implements PercistORM
{
    public function getAll(string $filter = null): array
    {
        $clients = Client::with(['encomendas.itens.itemable'])
            ->get()
            /* ->filter(function ($client) {
                return $client->encomendas->isNotEmpty();
            }) */
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
    public function findOne(string $id): Client|null
    {
        return Client::find($id);
    }
    public function delete(string $id): void
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
        }
    }
    public function new(array $dto): Client
    {
        $client = new Client();
        $client->fill((array) $dto);
        $client->save();

        // Handle photo upload if provided
        if (isset($dto['photo'])) {
            $this->handlePhotoUpload($client, $dto['photo']);
        }

        return $client;
    }
    public function update(array $dto): Client|null
    {
        $client = Client::find($dto['id'] ?? null);
        if ($client) {
            $client->fill((array) $dto);
            $client->save();
            return $client;
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

    private function handlePhotoUpload(Client $client, $photoData): void
    {
        // Assuming $photoData is an uploaded file or file data
        // For now, create a placeholder photo record
        // In a real implementation, you'd handle file upload to storage
        Photo::create([
            'path' => 'storage/photos/clientes/' . $client->id . '/profile.jpg',
            'filename' => 'profile.jpg',
            'mime_type' => $photoData['mime_type'] ?? 'image/jpeg',
            'size' => $photoData['size'] ?? 102400,
            'photoable_type' => Client::class,
            'photoable_id' => $client->id,
        ]);
    }
}
