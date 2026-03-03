<?php

namespace App\DTOs\Requests;

use App\DTOs\AbstractDTO;

/**
 * DTO for updating an existing Encomenda.
 */
readonly class UpdateEncomendaDTO extends AbstractDTO
{
    public function __construct(
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
            dataEncomenda: $data['data_encomenda'] ?? null,
            estado: $data['estado'] ?? null,
            total: isset($data['total']) ? (float) $data['total'] : null,
            observacoes: $data['observacoes'] ?? null,
        );
    }

    /**
     * Convert to array for model update.
     *
     * @return array
     */
    public function toModelArray(): array
    {
        return array_filter([
            'data_encomenda' => $this->dataEncomenda,
            'estado' => $this->estado,
            'total' => $this->total,
            'observacoes' => $this->observacoes,
        ], fn($value) => $value !== null);
    }
}

