<?php

namespace App\Application\DTOs\Responses;

use App\Application\DTOs\AbstractDTO;
use App\Models\ItemEncomenda;

/**
 * DTO for ItemEncomenda response data.
 */
readonly class ItemEncomendaDTO extends AbstractDTO implements \JsonSerializable
{
    public function __construct(
        public ?int $id = null,
        public ?string $tipo = null,
        public ?string $foto = null,
        public ?string $estado = null,
        public ?string $observacoes = null,
        public ?string $dataEnvio = null,
        public ?string $dataPrevisao = null,
        public ?MedidaResponseDTO $medida = null,
    ) {}

    /**
     * Create DTO from ItemEncomenda model.
     *
     * @param ItemEncomenda $item
     * @return static
     */
    public static function fromModel(ItemEncomenda $item): static
    {
        $medidaDTO = null;

        if ($item->medida_type && $item->medida_id) {
            $medidaModel = $item->medida;
            if ($medidaModel) {
                $medidaDTO = MedidaResponseDTO::fromModel($medidaModel, $item->tipo);
            }
        }

        return new static(
            id: $item->id,
            tipo: $item->tipo,
            foto: $item->foto,
            estado: $item->estado,
            observacoes: $item->observacoes,
            dataEnvio: $item->data_envio ? \Carbon\Carbon::parse($item->data_envio)->format('d-m-Y') : null,
            dataPrevisao: $item->data_previsao ? \Carbon\Carbon::parse($item->data_previsao)->format('d-m-Y') : null,
            medida: $medidaDTO,
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
            tipo: $data['tipo'] ?? null,
            foto: $data['foto'] ?? null,
            estado: $data['estado'] ?? null,
            observacoes: $data['observacoes'] ?? null,
            dataEnvio: $data['data_envio'] ?? null,
            dataPrevisao: $data['data_previsao'] ?? null,
            medida: isset($data['medida']) ? MedidaResponseDTO::fromArray($data['medida']) : null,
        );
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
            'tipo' => $this->tipo,
            'foto' => $this->foto,
            'estado' => $this->estado,
            'observacoes' => $this->observacoes,
            'data_envio' => $this->dataEnvio,
            'data_previsao' => $this->dataPrevisao,
            'medida' => $this->medida?->toArray(),
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

