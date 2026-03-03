<?php

namespace App\DTOs\Requests;

use App\DTOs\AbstractDTO;

/**
 * DTO for adding an item to an Encomenda.
 */
readonly class AddItemEncomendaDTO extends AbstractDTO
{
    public function __construct(
        public string $tipo,
        public ?int $clienteMedidasId = null,
        public ?string $estado = null,
        public ?string $observacoes = null,
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
            tipo: $data['tipo'],
            clienteMedidasId: $data['cliente_medidas_id'] ?? null,
            estado: $data['estado'] ?? 'pendente',
            observacoes: $data['observacoes'] ?? null,
            dataPrevisao: $data['data_previsao'] ?? null,
        );
    }

    /**
     * Convert to array for model creation.
     *
     * @param int $encomendaId
     * @return array
     */
    public function toModelArray(int $encomendaId): array
    {
        return array_filter([
            'encomenda_id' => $encomendaId,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
            'observacoes' => $this->observacoes,
            'data_previsao' => $this->dataPrevisao,
            'cliente_medidas_id' => $this->clienteMedidasId,
        ], fn($value) => $value !== null);
    }
}

