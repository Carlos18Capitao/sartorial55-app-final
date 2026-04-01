<?php

namespace App\Application\DTOs\Requests;

use App\Application\DTOs\AbstractDTO;

/**
 * DTO for creating a new Encomenda.
 */
readonly class CreateEncomendaDTO extends AbstractDTO
{
    public function __construct(
        public ?int $clienteId = null,
        public ?string $dataEncomenda = null,
        public ?string $estado = null,
        public ?float $total = null,
        public ?string $observacoes = null,
    ) {}

    /**
     * Create DTO from request array.
     *
     * @param array $data
     * @return static
     */
    public static function fromRequest(array $data): static
    {
        return new static(
            clienteId: $data['cliente_id'] ?? null,
            dataEncomenda: $data['data_encomenda'] ?? null,
            estado: $data['estado'] ?? null,
            total: isset($data['total']) ? (float) $data['total'] : null,
            observacoes: $data['observacoes'] ?? null,
        );
    }

    /**
     * Convert to array for model creation.
     *
     * @return array
     */
    public function toModelArray(): array
    {
        return array_filter([
            'cliente_id' => $this->clienteId,
            'data_encomenda' => $this->dataEncomenda,
            'estado' => $this->estado ?? 'pendente',
            'total' => $this->total,
            'observacoes' => $this->observacoes,
        ], fn($value) => $value !== null);
    }
}

