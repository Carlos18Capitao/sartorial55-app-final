<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\Encomenda;
use App\Models\User;

class EncomendaService
{
    /**
     * Get all encomendas with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($perPage = 15)
    {
        return Encomenda::with(['cliente', 'itens.medida'])->paginate($perPage);
    }

    /**
     * Get encomenda by ID.
     */
    public function getById(int $id): ?Encomenda
    {
        return Encomenda::with(['cliente', 'itens.medida'])->find($id);
    }

    /**
     * Create a new encomenda.
     */
    public function createEncomenda(Cliente $cliente, array $data): Encomenda
    {
        $encomenda = new Encomenda($data);
        $encomenda->cliente()->associate($cliente);
        $encomenda->save();

        return $encomenda;
    }

    /**
     * Update an existing encomenda.
     */
    public function updateEncomenda(int $id, array $data): ?Encomenda
    {
        $encomenda = Encomenda::find($id);

        if (!$encomenda) {
            return null;
        }

        $encomenda->update($data);

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
