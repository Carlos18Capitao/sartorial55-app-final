<?php

namespace App\Services\Contracts;

use App\Models\ClienteMedidas;
use App\Models\ItemEncomenda;

interface ItemEncomendaServiceInterface
{
    /**
     * Create a new item with medida.
     */
    public function createItem(array $data, int $encomendaId): ItemEncomenda;

    /**
     * Update an existing item.
     */
    public function updateItem(int $itemId, array $data): ?ItemEncomenda;

    /**
     * Delete an item.
     */
    public function deleteItem(int $itemId): bool;

    /**
     * Get item by ID.
     */
    public function getItemById(int $itemId): ?ItemEncomenda;

    /**
     * Create medida from default ClienteMedidas.
     */
    public function createMedidaFromDefault(ItemEncomenda $item, ClienteMedidas $defaultMedidas): ?ItemEncomenda;

    /**
     * Get the item type (camisa, colete, casaco, calca, fato).
     */
    public function getType(): string;
}

