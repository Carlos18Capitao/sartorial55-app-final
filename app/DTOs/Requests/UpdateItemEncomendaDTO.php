<?php

namespace App\DTOs\Requests;

use App\DTOs\AbstractDTO;

/**
 * DTO for updating an item in an Encomenda.
 */
readonly class UpdateItemEncomendaDTO extends AbstractDTO
{
    public function __construct(
        public ?string $estado = null,
        public ?string $observacoes = null,
        public ?string $dataEnvio = null,
        public ?string $dataPrevisao = null,
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
            estado: $data['estado'] ?? null,
            observacoes: $data['observacoes'] ?? null,
            dataEnvio: $data['data_envio'] ?? null,
            dataPrevisao: $data['data_previsao'] ?? null,
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
            'estado' => $this->estado,
            'observacoes' => $this->observacoes,
            'data_envio' => $this->dataEnvio,
            'data_previsao' => $this->dataPrevisao,
        ], fn($value) => $value !== null);
    }
}

