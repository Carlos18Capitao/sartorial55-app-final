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
        return Encomenda::with(['cliente', 'itens.medida'])->paginate($perPage);
    }

    /**
     * Get all encomendas as DTOs with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllAsDTO(int $perPage = 15): LengthAwarePaginator
    {
        $encomendas = Encomenda::with(['cliente.user', 'itens.medida'])->paginate($perPage);

        $encomendas->getCollection()->transform(function ($encomenda) {
            return EncomendaDTO::fromModel($encomenda);
        });

        return $encomendas;
    }

    /**
     * Get encomenda by ID.
     */
    public function getById(int $id): ?Encomenda
    {
        return Encomenda::with(['cliente', 'itens.medida'])->find($id);
    }

    /**
     * Get encomenda by ID as DTO.
     */
    public function getByIdAsDTO(int $id): ?EncomendaDTO
    {
        $encomenda = Encomenda::with(['cliente.user', 'itens.medida'])->find($id);

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
