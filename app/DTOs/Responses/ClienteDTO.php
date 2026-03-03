<?php

namespace App\DTOs\Responses;

use App\DTOs\AbstractDTO;
use App\Models\Cliente;

/**
 * DTO for Cliente response data.
 */
readonly class ClienteDTO extends AbstractDTO implements \JsonSerializable
{
    public function __construct(
        public ?int $id = null,
        public ?int $userId = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $telefone = null,
        public ?ClienteMedidasDTO $medidas = null,
        public ?array $encomendas = null,
    ) {}

    /**
     * Create DTO from Cliente model.
     *
     * @param Cliente $cliente
     * @param bool $includeRelations
     * @return static
     */
    public static function fromModel(Cliente $cliente, bool $includeRelations = true): static
    {
        $medidasDTO = null;
        $encomendasDTOs = null;
        $userName = null;
        $userEmail = null;

        if ($includeRelations) {
            // User data
            $userName = $cliente->user?->name;
            $userEmail = $cliente->user?->email;

            // Medidas data
            if ($cliente->relationLoaded('medidas') && $cliente->medidas) {
                $medidasDTO = ClienteMedidasDTO::fromModel($cliente->medidas);
            }

            // Encomendas data
            if ($cliente->relationLoaded('encomendas')) {
                $encomendasDTOs = $cliente->encomendas->map(function ($encomenda) {
                    return self::mapEncomendaToArray($encomenda);
                })->toArray();
            }
        }

        return new static(
            id: $cliente->id,
            userId: $cliente->user_id,
            name: $userName ?? $cliente->user?->name,
            email: $userEmail ?? $cliente->user?->email,
            telefone: $cliente->telefone,
            medidas: $medidasDTO,
            encomendas: $encomendasDTOs,
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
            userId: $data['user_id'] ?? null,
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            telefone: $data['telefone'] ?? null,
            medidas: isset($data['medidas']) ? ClienteMedidasDTO::fromArray($data['medidas']) : null,
            encomendas: isset($data['encomendas'])
                ? array_map(fn($encomenda) => self::mapEncomendaArray($encomenda), $data['encomendas'])
                : null,
        );
    }

    /**
     * Map encomenda model to array format.
     *
     * @param mixed $encomenda
     * @return array
     */
    private static function mapEncomendaToArray($encomenda): array
    {
        return [
            'id' => $encomenda->id,
            'data_encomenda' => $encomenda->data_encomenda?->format('d-m-Y'),
            'estado' => $encomenda->estado,
            'total' => $encomenda->total,
            'observacoes' => $encomenda->observacoes,
            'itens' => $encomenda->relationLoaded('itens')
                ? $encomenda->itens->map(function ($item) {
                    return self::mapItemToArray($item);
                })->toArray()
                : [],
        ];
    }

    /**
     * Map item array to expected format.
     *
     * @param array $item
     * @return array
     */
    private static function mapItemEncomendaArray(array $item): array
    {
        return [
            'id' => $item['id'] ?? null,
            'tipo' => $item['tipo'] ?? null,
            'foto' => $item['foto'] ?? null,
            'estado' => $item['estado'] ?? null,
            'observacoes' => $item['observacoes'] ?? null,
            'data_envio' => $item['data_envio'] ?? null,
            'data_previsao' => $item['data_previsao'] ?? null,
            'medida' => $item['medida'] ?? null,
        ];
    }

    /**
     * Map item model to array format.
     *
     * @param mixed $item
     * @return array
     */
    private static function mapItemToArray($item): array
    {
        $medida = null;

        if ($item->medida_type && $item->medida_id) {
            $medidaModel = $item->medida;
            if ($medidaModel) {
                $medida = [
                    'tipo' => $item->tipo,
                    'tipo_model' => $item->medida_type,
                    // Camisa
                    'colarinho' => $medidaModel->colarinho ?? null,
                    'ombro_ombro' => $medidaModel->ombro_ombro ?? null,
                    'peito' => $medidaModel->peito ?? null,
                    'cintura' => $medidaModel->cintura ?? null,
                    'anca' => $medidaModel->anca ?? null,
                    'bicep' => $medidaModel->bicep ?? null,
                    'comprimento_manga_direita' => $medidaModel->comprimento_manga_direita ?? null,
                    'comprimento_manga_esquerda' => $medidaModel->comprimento_manga_esquerda ?? null,
                    'comprimento_manga_curta' => $medidaModel->comprimento_manga_curta ?? null,
                    'punho_esquerdo' => $medidaModel->punho_esquerdo ?? null,
                    'punho_direito' => $medidaModel->punho_direito ?? null,
                    'comprimento' => $medidaModel->comprimento ?? null,
                    // Casaco
                    'base' => $medidaModel->base ?? null,
                    'distancia_ombro_botao' => $medidaModel->distancia_ombro_botao ?? null,
                    'comprimento_manga' => $medidaModel->comprimento_manga ?? null,
                    'boca_manga' => $medidaModel->boca_manga ?? null,
                    'meia_cinta' => $medidaModel->meia_cinta ?? null,
                    'meio_ombro' => $medidaModel->meio_ombro ?? null,
                    'meia_costa' => $medidaModel->meia_costa ?? null,
                    'comprimento_costa' => $medidaModel->comprimento_costa ?? null,
                    'comprimento_frente' => $medidaModel->comprimento_frente ?? null,
                    'racha_lateral' => $medidaModel->racha_lateral ?? null,
                    // Colete
                    'tamanho' => $medidaModel->tamanho ?? null,
                    'ombro_botao' => $medidaModel->ombro_botao ?? null,
                    // Calca
                    'cintura_calca' => $medidaModel->cintura ?? null,
                    'anca_calca' => $medidaModel->anca ?? null,
                    'coxa' => $medidaModel->coxa ?? null,
                    'joelho' => $medidaModel->joelho ?? null,
                    'comprimento_calca' => $medidaModel->comprimento ?? null,
                    'bainha' => $medidaModel->bainha ?? null,
                    'gancho_frente' => $medidaModel->gancho_frente ?? null,
                    'gancho_atras' => $medidaModel->gancho_atras ?? null,
                ];
            }
        }

        return [
            'id' => $item->id,
            'tipo' => $item->tipo,
            'foto' => $item->foto,
            'estado' => $item->estado,
            'observacoes' => $item->observacoes,
            'data_envio' => $item->data_envio?->format('d-m-Y'),
            'data_previsao' => $item->data_previsao?->format('d-m-Y'),
            'medida' => $medida,
        ];
    }

    /**
     * Map encomenda array.
     *
     * @param array $encomenda
     * @return array
     */
    private static function mapEncomendaArray(array $encomenda): array
    {
        return [
            'id' => $encomenda['id'] ?? null,
            'data_encomenda' => $encomenda['data_encomenda'] ?? null,
            'estado' => $encomenda['estado'] ?? null,
            'total' => $encomenda['total'] ?? null,
            'observacoes' => $encomenda['observacoes'] ?? null,
            'itens' => isset($encomenda['itens'])
                ? array_map(fn($item) => self::mapItemEncomendaArray($item), $encomenda['itens'])
                : [],
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
            'user_id' => $this->userId,
            'name' => $this->name,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'medidas' => $this->medidas?->toArray(),
            'encomendas' => $this->encomendas,
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

