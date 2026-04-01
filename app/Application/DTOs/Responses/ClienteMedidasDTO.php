<?php

namespace App\Application\DTOs\Responses;

use App\Application\DTOs\AbstractDTO;
use App\Models\ClienteMedidas;

/**
 * DTO for ClienteMedidas response data.
 */
readonly class ClienteMedidasDTO extends AbstractDTO implements \JsonSerializable
{
    public function __construct(
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
        public ?float $comprimentoCamisa = null,
        // Casaco measurements
        public ?float $base = null,
        public ?float $distanciaOmoBotao = null,
        public ?float $comprimentoMangaCasaco = null,
        public ?float $bicepCasaco = null,
        public ?float $bocaManga = null,
        public ?float $meiaCinta = null,
        public ?float $meioOmbro = null,
        public ?float $meiaCosta = null,
        public ?float $comprimentoCosta = null,
        public ?float $comprimentoFrente = null,
        public ?float $rachaLateralCasaco = null,
        // Colete measurements
        public ?float $tamanhoColete = null,
        public ?float $omoBotaoColete = null,
        public ?float $comprimentoFrenteColete = null,
        public ?float $comprimentoCostaColete = null,
        public ?float $meiaCintaColete = null,
        // Calca measurements
        public ?float $tamanhoCalca = null,
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
     * Create DTO from ClienteMedidas model.
     *
     * @param ClienteMedidas $medidas
     * @return static
     */
    public static function fromModel(ClienteMedidas $medidas): static
    {
        return new static(
            // Camisa
            colarinho: $medidas->colarinho !== null ? (float) $medidas->colarinho : null,
            ombroOmbro: $medidas->ombro_ombro !== null ? (float) $medidas->ombro_ombro : null,
            peito: $medidas->peito !== null ? (float) $medidas->peito : null,
            cintura: $medidas->cintura !== null ? (float) $medidas->cintura : null,
            anca: $medidas->anca !== null ? (float) $medidas->anca : null,
            bicep: $medidas->bicep !== null ? (float) $medidas->bicep : null,
            comprimentoMangaDireita: $medidas->comprimento_manga_direita !== null ? (float) $medidas->comprimento_manga_direita : null,
            comprimentoMangaEsquerda: $medidas->comprimento_manga_esquerda !== null ? (float) $medidas->comprimento_manga_esquerda : null,
            comprimentoMangaCurta: $medidas->comprimento_manga_curta !== null ? (float) $medidas->comprimento_manga_curta : null,
            punhoEsquerdo: $medidas->punho_esquerdo !== null ? (float) $medidas->punho_esquerdo : null,
            punhoDireito: $medidas->punho_direito !== null ? (float) $medidas->punho_direito : null,
            comprimentoCamisa: $medidas->comprimento_camisa !== null ? (float) $medidas->comprimento_camisa : null,
            // Casaco
            base: $medidas->base !== null ? (float) $medidas->base : null,
            distanciaOmoBotao: $medidas->distancia_ombro_botao !== null ? (float) $medidas->distancia_ombro_botao : null,
            comprimentoMangaCasaco: $medidas->comprimento_manga_casaco !== null ? (float) $medidas->comprimento_manga_casaco : null,
            bicepCasaco: $medidas->bicep_casaco !== null ? (float) $medidas->bicep_casaco : null,
            bocaManga: $medidas->boca_manga !== null ? (float) $medidas->boca_manga : null,
            meiaCinta: $medidas->meia_cinta !== null ? (float) $medidas->meia_cinta : null,
            meioOmbro: $medidas->meio_ombro !== null ? (float) $medidas->meio_ombro : null,
            meiaCosta: $medidas->meia_costa !== null ? (float) $medidas->meia_costa : null,
            comprimentoCosta: $medidas->comprimento_costa !== null ? (float) $medidas->comprimento_costa : null,
            comprimentoFrente: $medidas->comprimento_frente !== null ? (float) $medidas->comprimento_frente : null,
            rachaLateralCasaco: $medidas->racha_lateral_casaco !== null ? (float) $medidas->racha_lateral_casaco : null,
            // Colete
            tamanhoColete: $medidas->tamanho_colete !== null ? (float) $medidas->tamanho_colete : null,
            omoBotaoColete: $medidas->ombro_botao_colete !== null ? (float) $medidas->ombro_botao_colete : null,
            comprimentoFrenteColete: $medidas->comprimento_frente_colete !== null ? (float) $medidas->comprimento_frente_colete : null,
            comprimentoCostaColete: $medidas->comprimento_costa_colete !== null ? (float) $medidas->comprimento_costa_colete : null,
            meiaCintaColete: $medidas->meia_cinta_colete !== null ? (float) $medidas->meia_cinta_colete : null,
            // Calca
            tamanhoCalca: $medidas->tamanho_calca !== null ? (float) $medidas->tamanho_calca : null,
            cinturaCalca: $medidas->cintura_calca !== null ? (float) $medidas->cintura_calca : null,
            ancaCalca: $medidas->anca_calca !== null ? (float) $medidas->anca_calca : null,
            coxa: $medidas->coxa !== null ? (float) $medidas->coxa : null,
            joelho: $medidas->joelho !== null ? (float) $medidas->joelho : null,
            comprimentoCalca: $medidas->comprimento_calca !== null ? (float) $medidas->comprimento_calca : null,
            bainha: $medidas->bainha !== null ? (float) $medidas->bainha : null,
            ganchoFrente: $medidas->gancho_frente !== null ? (float) $medidas->gancho_frente : null,
            ganchoAtras: $medidas->gancho_atras !== null ? (float) $medidas->gancho_atras : null,
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
            comprimentoCamisa: isset($data['comprimento_camisa']) && $data['comprimento_camisa'] !== '' ? (float) $data['comprimento_camisa'] : null,
            // Casaco
            base: isset($data['base']) && $data['base'] !== '' ? (float) $data['base'] : null,
            distanciaOmoBotao: isset($data['distancia_ombro_botao']) && $data['distancia_ombro_botao'] !== '' ? (float) $data['distancia_ombro_botao'] : null,
            comprimentoMangaCasaco: isset($data['comprimento_manga_casaco']) && $data['comprimento_manga_casaco'] !== '' ? (float) $data['comprimento_manga_casaco'] : null,
            bicepCasaco: isset($data['bicep_casaco']) && $data['bicep_casaco'] !== '' ? (float) $data['bicep_casaco'] : null,
            bocaManga: isset($data['boca_manga']) && $data['boca_manga'] !== '' ? (float) $data['boca_manga'] : null,
            meiaCinta: isset($data['meia_cinta']) && $data['meia_cinta'] !== '' ? (float) $data['meia_cinta'] : null,
            meioOmbro: isset($data['meio_ombro']) && $data['meio_ombro'] !== '' ? (float) $data['meio_ombro'] : null,
            meiaCosta: isset($data['meia_costa']) && $data['meia_costa'] !== '' ? (float) $data['meia_costa'] : null,
            comprimentoCosta: isset($data['comprimento_costa']) && $data['comprimento_costa'] !== '' ? (float) $data['comprimento_costa'] : null,
            comprimentoFrente: isset($data['comprimento_frente']) && $data['comprimento_frente'] !== '' ? (float) $data['comprimento_frente'] : null,
            rachaLateralCasaco: isset($data['racha_lateral_casaco']) && $data['racha_lateral_casaco'] !== '' ? (float) $data['racha_lateral_casaco'] : null,
            // Colete
            tamanhoColete: isset($data['tamanho_colete']) && $data['tamanho_colete'] !== '' ? (float) $data['tamanho_colete'] : null,
            omoBotaoColete: isset($data['ombro_botao_colete']) && $data['ombro_botao_colete'] !== '' ? (float) $data['ombro_botao_colete'] : null,
            comprimentoFrenteColete: isset($data['comprimento_frente_colete']) && $data['comprimento_frente_colete'] !== '' ? (float) $data['comprimento_frente_colete'] : null,
            comprimentoCostaColete: isset($data['comprimento_costa_colete']) && $data['comprimento_costa_colete'] !== '' ? (float) $data['comprimento_costa_colete'] : null,
            meiaCintaColete: isset($data['meia_cinta_colete']) && $data['meia_cinta_colete'] !== '' ? (float) $data['meia_cinta_colete'] : null,
            // Calca
            tamanhoCalca: isset($data['tamanho_calca']) && $data['tamanho_calca'] !== '' ? (float) $data['tamanho_calca'] : null,
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
            'comprimento_camisa' => $this->comprimentoCamisa,
            // Casaco
            'base' => $this->base,
            'distancia_ombro_botao' => $this->distanciaOmoBotao,
            'comprimento_manga_casaco' => $this->comprimentoMangaCasaco,
            'bicep_casaco' => $this->bicepCasaco,
            'boca_manga' => $this->bocaManga,
            'meia_cinta' => $this->meiaCinta,
            'meio_ombro' => $this->meioOmbro,
            'meia_costa' => $this->meiaCosta,
            'comprimento_costa' => $this->comprimentoCosta,
            'comprimento_frente' => $this->comprimentoFrente,
            'racha_lateral_casaco' => $this->rachaLateralCasaco,
            // Colete
            'tamanho_colete' => $this->tamanhoColete,
            'ombro_botao_colete' => $this->omoBotaoColete,
            'comprimento_frente_colete' => $this->comprimentoFrenteColete,
            'comprimento_costa_colete' => $this->comprimentoCostaColete,
            'meia_cinta_colete' => $this->meiaCintaColete,
            // Calca
            'tamanho_calca' => $this->tamanhoCalca,
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

