<?php

namespace App\DTOs\Responses;

use App\DTOs\AbstractDTO;
use App\Models\Encomenda;

/**
 * DTO for Encomenda response data.
 */
readonly class EncomendaDTO extends AbstractDTO
{
    public function __construct(
        public ?int $id = null,
        public ?int $clienteId = null,
        public ?string $dataEncomenda = null,
        public ?string $estado = null,
        public ?float $total = null,
        public ?string $observacoes = null,
        public ?ClienteDTO $cliente = null,
        public ?array $itens = null,
    ) {}

    /**
     * Create DTO from Encomenda model.
     *
     * @param Encomenda $encomenda
     * @param bool $includeRelations
     * @return static
     */
    public static function fromModel(Encomenda $encomenda, bool $includeRelations = true): static
    {
        $clienteDTO = null;
        $itensDTOs = null;

        if ($includeRelations) {
            if ($encomenda->relationLoaded('cliente') && $encomenda->cliente) {
                $clienteDTO = ClienteDTO::fromModel($encomenda->cliente, false);
            }

            if ($encomenda->relationLoaded('itens')) {
                $itensDTOs = $encomenda->itens->map(fn($item) => ItemEncomendaDTO::fromModel($item))->toArray();
            }
        }

        return new static(
            id: $encomenda->id,
            clienteId: $encomenda->cliente_id,
            dataEncomenda: $encomenda->data_encomenda?->format('Y-m-d'),
            estado: $encomenda->estado,
            total: $encomenda->total,
            observacoes: $encomenda->observacoes,
            cliente: $clienteDTO,
            itens: $itensDTOs,
        );
    }

    /**
     * Create DTO from array.
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(
            id: $data['id'] ?? null,
            clienteId: $data['cliente_id'] ?? null,
            dataEncomenda: $data['data_encomenda'] ?? null,
            estado: $data['estado'] ?? null,
            total: $data['total'] ?? null,
            observacoes: $data['observacoes'] ?? null,
            cliente: isset($data['cliente']) ? ClienteDTO::fromArray($data['cliente']) : null,
            itens: isset($data['itens'])
                ? array_map(fn($item) => ItemEncomendaDTO::fromArray($item), $data['itens'])
                : null,
        );
    }

    /**
     * Convert to simple array (for list views without nested relations).
     *
     * @return array
     */
    public function toSimpleArray(): array
    {
        return [
            'id' => $this->id,
            'cliente_id' => $this->clienteId,
            'data_encomenda' => $this->dataEncomenda,
            'estado' => $this->estado,
            'total' => $this->total,
            'observacoes' => $this->observacoes,
        ];
    }
}

