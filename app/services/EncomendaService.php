<?php

namespace App\Services;

use App\DTOs\Requests\CreateEncomendaDTO;
use App\DTOs\Requests\UpdateEncomendaDTO;
use App\DTOs\Responses\EncomendaDTO;
use App\Models\Encomenda;
use Illuminate\Pagination\LengthAwarePaginator;

class EncomendaService
{
    /**
     * Get all encomendas with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return Encomenda::with('cliente.user')
            ->withCount(['itens', 'itens as camisa_count' => fn($query) => $query->where('tipo', 'camisa'), 'itens as casaco_count' => fn($query) => $query->where('tipo', 'casaco'), 'itens as colete_count' => fn($query) => $query->where('tipo', 'colete'), 'itens as calca_count' => fn($query) => $query->where('tipo', 'calca'), 'itens as fato_count' => fn($query) => $query->where('tipo', 'fato')])
            ->paginate($perPage);
    }

    /**
     * Get all encomendas as DTOs with pagination.
     *
     * @param int $perPage
     * @return array
     */
    public function getAllAsDTO(int $perPage = 15): array
    {
        $encomendas = Encomenda::with(['cliente.user', 'itens.medida'])
            ->withCount(['itens', 'itens as camisa_count' => fn($query) => $query->where('tipo', 'camisa'), 
            'itens as casaco_count' => fn($query) => $query->where('tipo', 'casaco'), 
            'itens as colete_count' => fn($query) => $query->where('tipo', 'colete'), 
            'itens as calca_count' => fn($query) => $query->where('tipo', 'calca'), 
            'itens as sapato_count' => fn($query) => $query->where('tipo', 'sapato'), 
            'itens as fato_count' => fn($query) => $query->where('tipo', 'fato')])
            ->paginate($perPage);

        $items = $encomendas
            ->getCollection()
            ->map(function ($encomenda) {
                return EncomendaDTO::fromModel($encomenda)->toArray();
            })
            ->toArray();

        return [
            'current_page' => $encomendas->currentPage(),
            'data' => $items,
            'first_page_url' => $encomendas->url(1),
            'from' => $encomendas->firstItem(),
            'last_page' => $encomendas->lastPage(),
            'last_page_url' => $encomendas->url($encomendas->lastPage()),
            'links' => $encomendas->linkCollection()->toArray(),
            'next_page_url' => $encomendas->nextPageUrl(),
            'path' => $encomendas->path(),
            'per_page' => $encomendas->perPage(),
            'prev_page_url' => $encomendas->previousPageUrl(),
            'to' => $encomendas->lastItem(),
            'total' => $encomendas->total(),
        ];
    }

    /**
     * Get encomenda by ID.
     */
    public function getById(int $id): ?Encomenda
    {
        return Encomenda::with(['cliente', 'itens.medida'])
        ->withCount(['itens', 'itens as camisa_count' => fn($query) => $query->where('tipo', 'camisa'), 
            'itens as casaco_count' => fn($query) => $query->where('tipo', 'casaco'), 
            'itens as colete_count' => fn($query) => $query->where('tipo', 'colete'), 
            'itens as calca_count' => fn($query) => $query->where('tipo', 'calca'), 
            'itens as sapato_count' => fn($query) => $query->where('tipo', 'sapato'), 
            'itens as fato_count' => fn($query) => $query->where('tipo', 'fato')])
        ->find($id);
    }

    /**
     * Get encomenda by ID as DTO.
     */
    public function getByIdAsDTO(int $id): ?EncomendaDTO
    {
        $encomenda = Encomenda::with(['cliente.user', 'itens.medida'])
        ->withCount(['itens', 'itens as camisa_count' => fn($query) => $query->where('tipo', 'camisa'), 
            'itens as casaco_count' => fn($query) => $query->where('tipo', 'casaco'), 
            'itens as colete_count' => fn($query) => $query->where('tipo', 'colete'), 
            'itens as calca_count' => fn($query) => $query->where('tipo', 'calca'), 
            'itens as sapato_count' => fn($query) => $query->where('tipo', 'sapato'), 
            'itens as fato_count' => fn($query) => $query->where('tipo', 'fato')])
        ->find($id);

        if (!$encomenda) {
            return null;
        }

        return EncomendaDTO::fromModel($encomenda);
    }

    /**
     * Create a new encomenda.
     */
    public function createEncomenda(CreateEncomendaDTO $dto): Encomenda
    {
        $encomenda = new Encomenda($dto->toModelArray());
        $encomenda->save();

        return $encomenda;
    }

    /**
     * Update an existing encomenda.
     */
    public function updateEncomenda(int $id, UpdateEncomendaDTO $dto): ?Encomenda
    {
        $encomenda = Encomenda::find($id);

        if (!$encomenda) {
            return null;
        }

        $encomenda->update($dto->toModelArray());

        return $encomenda;
    }

    /**
     * Delete an encomenda.
     */
    public function deleteEncomenda(int $id): bool
    {
        $encomenda = Encomenda::find($id);

        if (!$encomenda) {
            return false;
        }

        $encomenda->delete();

        return true;
    }
}
