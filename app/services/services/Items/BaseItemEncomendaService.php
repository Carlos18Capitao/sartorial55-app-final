<?php

namespace App\Services;

use App\Models\ItemEncomenda;
use App\Models\ClienteMedidas;

use App\Services\Contracts\ItemEncomendaServiceInterface;

abstract class BaseItemEncomendaService implements ItemEncomendaServiceInterface
{
    /**
     * Create a new item.
     */
    public function createItem(array $data, int $encomendaId): ItemEncomenda
    {
        $itemData = [
            'encomenda_id' => $encomendaId,
            'tipo' => $this->getType(),
            'estado' => $data['estado'] ?? 'pendente',
            'observacoes' => $data['observacoes'] ?? null,
            'data_previsao' => $data['data_previsao'] ?? null,
            'data_envio' => $data['data_envio'] ?? null,
            'foto' => $data['foto'] ?? null,
        ];

        // If cliente_medidas_id is provided, store it for later use
        if (!empty($data['cliente_medidas_id'])) {
            $itemData['cliente_medidas_id'] = $data['cliente_medidas_id'];
        }

        $item = ItemEncomenda::create($itemData);

        // If using default measurements, create the medida
        if (!empty($data['cliente_medidas_id'])) {
            $defaultMedidas = ClienteMedidas::find($data['cliente_medidas_id']);
            if ($defaultMedidas) {
                $this->createMedidaFromDefault($item, $defaultMedidas);
            }
        }

        return $item->load('medida');
    }

    /**
     * Update an existing item.
     */
    public function updateItem(int $itemId, array $data): ?ItemEncomenda
    {
        $item = ItemEncomenda::find($itemId);

        if (!$item) {
            return null;
        }

        $updateData = [];

        if (isset($data['estado'])) {
            $updateData['estado'] = $data['estado'];
        }
        if (isset($data['observacoes'])) {
            $updateData['observacoes'] = $data['observacoes'];
        }
        if (isset($data['data_envio'])) {
            $updateData['data_envio'] = $data['data_envio'];
        }
        if (isset($data['data_previsao'])) {
            $updateData['data_previsao'] = $data['data_previsao'];
        }
        if (isset($data['foto'])) {
            $updateData['foto'] = $data['foto'];
        }

        $item->update($updateData);

        return $item->fresh('medida');
    }

    /**
     * Delete an item.
     */
    public function deleteItem(int $itemId): bool
    {
        $item = ItemEncomenda::find($itemId);

        if (!$item) {
            return false;
        }

        // Delete the associated medida if exists
        if ($item->medida) {
            $item->medida->delete();
        }

        $item->delete();

        return true;
    }

    /**
     * Get item by ID.
     */
    public function getItemById(int $itemId): ?ItemEncomenda
    {
        return ItemEncomenda::with('medida')->find($itemId);
    }

    /**
     * Get the item type - must be implemented by child classes.
     */
    abstract public function getType(): string;

    /**
     * Create the medida from default ClienteMedidas - must be implemented by child classes.
     */
    abstract public function createMedidaFromDefault(ItemEncomenda $item, ClienteMedidas $defaultMedidas): ?ItemEncomenda;
}
