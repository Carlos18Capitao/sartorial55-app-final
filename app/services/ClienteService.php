<?php

namespace App\Services;

use App\DTOs\Requests\CreateClienteDTO;
use App\DTOs\Requests\UpdateClienteDTO;
use App\DTOs\Requests\UpdateClienteMedidasDTO;
use App\DTOs\Responses\ClienteDTO;
use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteService
{
    /**
     * Get all clientes with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return Cliente::with(['user', 'encomendas', 'medidas'])->paginate($perPage);
    }

    /**
     * Get all clientes as DTOs with pagination.
     *
     * @param int $perPage
     * @return array
     */
    public function getAllAsDTO(int $perPage = 15): array
    {
        $clientes = Cliente::with(['user', 'encomendas.itens.medida', 'medidas'])->paginate($perPage);

        $items = $clientes->getCollection()->map(function ($cliente) {
            return ClienteDTO::fromModel($cliente)->toArray();
        })->toArray();

        return [
            'current_page' => $clientes->currentPage(),
            'data' => $items,
            'first_page_url' => $clientes->url(1),
            'from' => $clientes->firstItem(),
            'last_page' => $clientes->lastPage(),
            'last_page_url' => $clientes->url($clientes->lastPage()),
            'links' => $clientes->linkCollection()->toArray(),
            'next_page_url' => $clientes->nextPageUrl(),
            'path' => $clientes->path(),
            'per_page' => $clientes->perPage(),
            'prev_page_url' => $clientes->previousPageUrl(),
            'to' => $clientes->lastItem(),
            'total' => $clientes->total(),
        ];
    }

    /**
     * Get cliente by ID.
     *
     * @param int $id
     * @return Cliente|null
     */
    public function getById(int $id): ?Cliente
    {
        return Cliente::with(['user', 'encomendas', 'medidas'])->find($id);
    }

    /**
     * Get cliente by ID as DTO.
     *
     * @param int $id
     * @return ClienteDTO|null
     */
    public function getByIdAsDTO(int $id): ?ClienteDTO
    {
        $cliente = Cliente::with(['user', 'encomendas.itens.medida', 'medidas'])->find($id);

        if (!$cliente) {
            return null;
        }

        return ClienteDTO::fromModel($cliente);
    }

    /**
     * Get cliente by user ID.
     *
     * @param int $userId
     * @return Cliente|null
     */
    public function getByUserId(int $userId): ?Cliente
    {
        return Cliente::where('user_id', $userId)->first();
    }

    /**
     * Create a new cliente.
     *
     * @param CreateClienteDTO $dto
     * @return Cliente
     */
    public function create(CreateClienteDTO $dto): Cliente
    {
        $user = User::create($dto->toUserArray());

        return Cliente::create($dto->toClienteArray($user->id));
    }

    /**
     * Update an existing cliente.
     *
     * @param int $id
     * @param UpdateClienteDTO $dto
     * @return Cliente|null
     */
    public function update(int $id, UpdateClienteDTO $dto): ?Cliente
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return null;
        }

        $cliente->update($dto->toModelArray());

        return $cliente->fresh();
    }

    /**
     * Update or create cliente medidas.
     *
     * @param int $clienteId
     * @param UpdateClienteMedidasDTO $dto
     * @return ClienteMedidas
     */
    public function updateMedidas(int $clienteId, UpdateClienteMedidasDTO $dto): ClienteMedidas
    {
        return ClienteMedidas::updateOrCreate(
            ['cliente_id' => $clienteId],
            $dto->toModelArray()
        );
    }

    /**
     * Delete a cliente.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return false;
        }

        return $cliente->delete();
    }
}
