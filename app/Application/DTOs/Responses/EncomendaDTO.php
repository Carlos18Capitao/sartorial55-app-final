<?php

namespace App\Application\DTOs\Responses;

use App\Application\DTOs\AbstractDTO;
use App\Models\Encomenda;

/**
 * DTO for Encomenda response data.
 */
readonly class EncomendaDTO extends AbstractDTO implements \JsonSerializable
{
    public function __construct(
        public ?int $id = null,
        public ?int $clienteId = null,
        public ?string $dataEncomenda = null,
        public ?string $estado = null,
        public ?float $total = null,
        public ?string $observacoes = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
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
            dataEncomenda: $encomenda->data_encomenda instanceof \DateTimeInterface
                ? $encomenda->data_encomenda->format('d-m-Y')
                : ($encomenda->data_encomenda ? \Carbon\Carbon::parse($encomenda->data_encomenda)->format('d-m-Y') : null),
            estado: $encomenda->estado,
            total: $encomenda->total,
            observacoes: $encomenda->observacoes,
            createdAt: $encomenda->created_at?->format('Y-m-d H:i:s'),
            updatedAt: $encomenda->updated_at?->format('Y-m-d H:i:s'),
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
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
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
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    /**
     * Convert the DTO to an array with snake_case keys.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cliente_id' => $this->clienteId,
            'data_encomenda' => $this->dataEncomenda,
            'estado' => $this->estado,
            'total' => $this->total,
            'observacoes' => $this->observacoes,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'cliente' => $this->cliente?->toArray(),
            'itens' => $this->itens ? array_map(fn($item) => $item->toArray(), $this->itens) : null,
        ];
    }

    /**
     * Serialize the DTO to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}

