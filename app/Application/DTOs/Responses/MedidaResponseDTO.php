<?php

namespace App\Application\DTOs\Responses;

use App\Application\DTOs\AbstractDTO;
use Illuminate\Database\Eloquent\Model;

/**
 * DTO for generic Medida response data (polymorphic).
 */
readonly class MedidaResponseDTO extends AbstractDTO implements \JsonSerializable
{
    public function __construct(
        public ?string $tipo = null,
        public ?string $tipoModel = null,
        // Camisa measurements
        public ?float $colarinho = null,
        public ?float $ombroOmbro = null,
        public ?float $peito = null,
        public ?float $cintura = null,
        public ?float $anca = null,
        public ?float $bicep = null,
        public ?float $comprimentoMangaDireita = null,
        public ?float $comprimentoMangaEsquerda = null,
        public ?float $comprimentoMangaCurta = null,
        public ?float $punhoEsquerdo = null,
        public ?float $punhoDireito = null,
        public ?float $comprimento = null,
        // Casaco measurements
        public ?float $base = null,
        public ?float $distanciaOmoBotao = null,
        public ?float $comprimentoManga = null,
        public ?float $bocaManga = null,
        public ?float $meiaCinta = null,
        public ?float $meioOmbro = null,
        public ?float $meiaCosta = null,
        public ?float $comprimentoCosta = null,
        public ?float $comprimentoFrente = null,
        public ?float $rachaLateral = null,
        // Colete measurements
        public ?float $tamanho = null,
        public ?float $omoBotao = null,
        // Calca measurements
        public ?float $cinturaCalca = null,
        public ?float $ancaCalca = null,
        public ?float $coxa = null,
        public ?float $joelho = null,
        public ?float $comprimentoCalca = null,
        public ?float $bainha = null,
        public ?float $ganchoFrente = null,
        public ?float $ganchoAtras = null,
    ) {}

    /**
     * Create DTO from any Medida model.
     *
     * @param Model $medida
     * @param string $tipo
     * @return static
     */
    public static function fromModel(Model $medida, string $tipo): static
    {
        return new static(
            tipo: $tipo,
            tipoModel: get_class($medida),
            // Camisa measurements
            colarinho: $medida->colarinho !== null ? (float) $medida->colarinho : null,
            ombroOmbro: $medida->ombro_ombro !== null ? (float) $medida->ombro_ombro : null,
            peito: $medida->peito !== null ? (float) $medida->peito : null,
            cintura: $medida->cintura !== null ? (float) $medida->cintura : null,
            anca: $medida->anca !== null ? (float) $medida->anca : null,
            bicep: $medida->bicep !== null ? (float) $medida->bicep : null,
            comprimentoMangaDireita: $medida->comprimento_manga_direita !== null ? (float) $medida->comprimento_manga_direita : null,
            comprimentoMangaEsquerda: $medida->comprimento_manga_esquerda !== null ? (float) $medida->comprimento_manga_esquerda : null,
            comprimentoMangaCurta: $medida->comprimento_manga_curta !== null ? (float) $medida->comprimento_manga_curta : null,
            punhoEsquerdo: $medida->punho_esquerdo !== null ? (float) $medida->punho_esquerdo : null,
            punhoDireito: $medida->punho_direito !== null ? (float) $medida->punho_direito : null,
            comprimento: $medida->comprimento !== null ? (float) $medida->comprimento : null,
            // Casaco measurements
            base: $medida->base !== null ? (float) $medida->base : null,
            distanciaOmoBotao: $medida->distancia_ombro_botao !== null ? (float) $medida->distancia_ombro_botao : null,
            comprimentoManga: $medida->comprimento_manga !== null ? (float) $medida->comprimento_manga : null,
            bocaManga: $medida->boca_manga !== null ? (float) $medida->boca_manga : null,
            meiaCinta: $medida->meia_cinta !== null ? (float) $medida->meia_cinta : null,
            meioOmbro: $medida->meio_ombro !== null ? (float) $medida->meio_ombro : null,
            meiaCosta: $medida->meia_costa !== null ? (float) $medida->meia_costa : null,
            comprimentoCosta: $medida->comprimento_costa !== null ? (float) $medida->comprimento_costa : null,
            comprimentoFrente: $medida->comprimento_frente !== null ? (float) $medida->comprimento_frente : null,
            rachaLateral: $medida->racha_lateral !== null ? (float) $medida->racha_lateral : null,
            // Coleste measurements
            tamanho: $medida->tamanho !== null ? (float) $medida->tamanho : null,
            omoBotao: $medida->ombro_botao !== null ? (float) $medida->ombro_botao : null,
            // Calca measurements
            cinturaCalca: $medida->cintura !== null ? (float) $medida->cintura : null,
            ancaCalca: $medida->anca !== null ? (float) $medida->anca : null,
            coxa: $medida->coxa !== null ? (float) $medida->coxa : null,
            joelho: $medida->joelho !== null ? (float) $medida->joelho : null,
            comprimentoCalca: $medida->comprimento !== null ? (float) $medida->comprimento : null,
            bainha: $medida->bainha !== null ? (float) $medida->bainha : null,
            ganchoFrente: $medida->gancho_frente !== null ? (float) $medida->gancho_frente : null,
            ganchoAtras: $medida->gancho_atras !== null ? (float) $medida->gancho_atras : null,
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
            tipo: $data['tipo'] ?? null,
            tipoModel: $data['tipo_model'] ?? null,
            // Camisa
            colarinho: isset($data['colarinho']) && $data['colarinho'] !== '' ? (float) $data['colarinho'] : null,
            ombroOmbro: isset($data['ombro_ombro']) && $data['ombro_ombro'] !== '' ? (float) $data['ombro_ombro'] : null,
            peito: isset($data['peito']) && $data['peito'] !== '' ? (float) $data['peito'] : null,
            cintura: isset($data['cintura']) && $data['cintura'] !== '' ? (float) $data['cintura'] : null,
            anca: isset($data['anca']) && $data['anca'] !== '' ? (float) $data['anca'] : null,
            bicep: isset($data['bicep']) && $data['bicep'] !== '' ? (float) $data['bicep'] : null,
            comprimentoMangaDireita: isset($data['comprimento_manga_direita']) && $data['comprimento_manga_direita'] !== '' ? (float) $data['comprimento_manga_direita'] : null,
            comprimentoMangaEsquerda: isset($data['comprimento_manga_esquerda']) && $data['comprimento_manga_esquerda'] !== '' ? (float) $data['comprimento_manga_esquerda'] : null,
            comprimentoMangaCurta: isset($data['comprimento_manga_curta']) && $data['comprimento_manga_curta'] !== '' ? (float) $data['comprimento_manga_curta'] : null,
            punhoEsquerdo: isset($data['punho_esquerdo']) && $data['punho_esquerdo'] !== '' ? (float) $data['punho_esquerdo'] : null,
            punhoDireito: isset($data['punho_direito']) && $data['punho_direito'] !== '' ? (float) $data['punho_direito'] : null,
            comprimento: isset($data['comprimento']) && $data['comprimento'] !== '' ? (float) $data['comprimento'] : null,
            // Casaco
            base: isset($data['base']) && $data['base'] !== '' ? (float) $data['base'] : null,
            distanciaOmoBotao: isset($data['distancia_ombro_botao']) && $data['distancia_ombro_botao'] !== '' ? (float) $data['distancia_ombro_botao'] : null,
            comprimentoManga: isset($data['comprimento_manga']) && $data['comprimento_manga'] !== '' ? (float) $data['comprimento_manga'] : null,
            bocaManga: isset($data['boca_manga']) && $data['boca_manga'] !== '' ? (float) $data['boca_manga'] : null,
            meiaCinta: isset($data['meia_cinta']) && $data['meia_cinta'] !== '' ? (float) $data['meia_cinta'] : null,
            meioOmbro: isset($data['meio_ombro']) && $data['meio_ombro'] !== '' ? (float) $data['meio_ombro'] : null,
            meiaCosta: isset($data['meia_costa']) && $data['meia_costa'] !== '' ? (float) $data['meia_costa'] : null,
            comprimentoCosta: isset($data['comprimento_costa']) && $data['comprimento_costa'] !== '' ? (float) $data['comprimento_costa'] : null,
            comprimentoFrente: isset($data['comprimento_frente']) && $data['comprimento_frente'] !== '' ? (float) $data['comprimento_frente'] : null,
            rachaLateral: isset($data['racha_lateral']) && $data['racha_lateral'] !== '' ? (float) $data['racha_lateral'] : null,
            // Colete
            tamanho: isset($data['tamanho']) && $data['tamanho'] !== '' ? (float) $data['tamanho'] : null,
            omoBotao: isset($data['ombro_botao']) && $data['ombro_botao'] !== '' ? (float) $data['ombro_botao'] : null,
            // Calca
            cinturaCalca: isset($data['cintura_calca']) && $data['cintura_calca'] !== '' ? (float) $data['cintura_calca'] : null,
            ancaCalca: isset($data['anca_calca']) && $data['anca_calca'] !== '' ? (float) $data['anca_calca'] : null,
            coxa: isset($data['coxa']) && $data['coxa'] !== '' ? (float) $data['coxa'] : null,
            joelho: isset($data['joelho']) && $data['joelho'] !== '' ? (float) $data['joelho'] : null,
            comprimentoCalca: isset($data['comprimento_calca']) && $data['comprimento_calca'] !== '' ? (float) $data['comprimento_calca'] : null,
            bainha: isset($data['bainha']) && $data['bainha'] !== '' ? (float) $data['bainha'] : null,
            ganchoFrente: isset($data['gancho_frente']) && $data['gancho_frente'] !== '' ? (float) $data['gancho_frente'] : null,
            ganchoAtras: isset($data['gancho_atras']) && $data['gancho_atras'] !== '' ? (float) $data['gancho_atras'] : null,
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
            'tipo' => $this->tipo,
            'tipo_model' => $this->tipoModel,
            // Camisa
            'colarinho' => $this->colarinho,
            'ombro_ombro' => $this->ombroOmbro,
            'peito' => $this->peito,
            'cintura' => $this->cintura,
            'anca' => $this->anca,
            'bicep' => $this->bicep,
            'comprimento_manga_direita' => $this->comprimentoMangaDireita,
            'comprimento_manga_esquerda' => $this->comprimentoMangaEsquerda,
            'comprimento_manga_curta' => $this->comprimentoMangaCurta,
            'punho_esquerdo' => $this->punhoEsquerdo,
            'punho_direito' => $this->punhoDireito,
            'comprimento' => $this->comprimento,
            // Casaco
            'base' => $this->base,
            'distancia_ombro_botao' => $this->distanciaOmoBotao,
            'comprimento_manga' => $this->comprimentoManga,
            'boca_manga' => $this->bocaManga,
            'meia_cinta' => $this->meiaCinta,
            'meio_ombro' => $this->meioOmbro,
            'meia_costa' => $this->meiaCosta,
            'comprimento_costa' => $this->comprimentoCosta,
            'comprimento_frente' => $this->comprimentoFrente,
            'racha_lateral' => $this->rachaLateral,
            // Colete
            'tamanho' => $this->tamanho,
            'ombro_botao' => $this->omoBotao,
            // Calca
            'cintura_calca' => $this->cinturaCalca,
            'anca_calca' => $this->ancaCalca,
            'coxa' => $this->coxa,
            'joelho' => $this->joelho,
            'comprimento_calca' => $this->comprimentoCalca,
            'bainha' => $this->bainha,
            'gancho_frente' => $this->ganchoFrente,
            'gancho_atras' => $this->ganchoAtras,
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

