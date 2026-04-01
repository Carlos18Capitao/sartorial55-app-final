<?php

namespace App\Application\DTOs\Requests;

use App\Application\DTOs\AbstractDTO;

/**
 * DTO for updating ClienteMedicas.
 */
readonly class UpdateClienteMedidasDTO extends AbstractDTO
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
     * Create DTO from request array.
     *
     * @param array $data
     * @return static
     */
    public static function fromRequest(array $data): static
    {
        return new static(
            // Camisa
            colarinho: isset($data['colarinho']) ? (float) $data['colarinho'] : null,
            ombroOmbro: isset($data['ombro_ombro']) ? (float) $data['ombro_ombro'] : null,
            peito: isset($data['peito']) ? (float) $data['peito'] : null,
            cintura: isset($data['cintura']) ? (float) $data['cintura'] : null,
            anca: isset($data['anca']) ? (float) $data['anca'] : null,
            bicep: isset($data['bicep']) ? (float) $data['bicep'] : null,
            comprimentoMangaDireita: isset($data['comprimento_manga_direita']) ? (float) $data['comprimento_manga_direita'] : null,
            comprimentoMangaEsquerda: isset($data['comprimento_manga_esquerda']) ? (float) $data['comprimento_manga_esquerda'] : null,
            comprimentoMangaCurta: isset($data['comprimento_manga_curta']) ? (float) $data['comprimento_manga_curta'] : null,
            punhoEsquerdo: isset($data['punho_esquerdo']) ? (float) $data['punho_esquerdo'] : null,
            punhoDireito: isset($data['punho_direito']) ? (float) $data['punho_direito'] : null,
            comprimentoCamisa: isset($data['comprimento_camisa']) ? (float) $data['comprimento_camisa'] : null,
            // Casaco
            base: isset($data['base']) ? (float) $data['base'] : null,
            distanciaOmoBotao: isset($data['distancia_ombro_botao']) ? (float) $data['distancia_ombro_botao'] : null,
            comprimentoMangaCasaco: isset($data['comprimento_manga_casaco']) ? (float) $data['comprimento_manga_casaco'] : null,
            bicepCasaco: isset($data['bicep_casaco']) ? (float) $data['bicep_casaco'] : null,
            bocaManga: isset($data['boca_manga']) ? (float) $data['boca_manga'] : null,
            meiaCinta: isset($data['meia_cinta']) ? (float) $data['meia_cinta'] : null,
            meioOmbro: isset($data['meio_ombro']) ? (float) $data['meio_ombro'] : null,
            meiaCosta: isset($data['meia_costa']) ? (float) $data['meia_costa'] : null,
            comprimentoCosta: isset($data['comprimento_costa']) ? (float) $data['comprimento_costa'] : null,
            comprimentoFrente: isset($data['comprimento_frente']) ? (float) $data['comprimento_frente'] : null,
            rachaLateralCasaco: isset($data['racha_lateral_casaco']) ? (float) $data['racha_lateral_casaco'] : null,
            // Colete
            tamanhoColete: isset($data['tamanho_colete']) ? (float) $data['tamanho_colete'] : null,
            omoBotaoColete: isset($data['ombro_botao_colete']) ? (float) $data['ombro_botao_colete'] : null,
            comprimentoFrenteColete: isset($data['comprimento_frente_colete']) ? (float) $data['comprimento_frente_colete'] : null,
            comprimentoCostaColete: isset($data['comprimento_costa_colete']) ? (float) $data['comprimento_costa_colete'] : null,
            meiaCintaColete: isset($data['meia_cinta_colete']) ? (float) $data['meia_cinta_colete'] : null,
            // Calca
            tamanhoCalca: isset($data['tamanho_calca']) ? (float) $data['tamanho_calca'] : null,
            cinturaCalca: isset($data['cintura_calca']) ? (float) $data['cintura_calca'] : null,
            ancaCalca: isset($data['anca_calca']) ? (float) $data['anca_calca'] : null,
            coxa: isset($data['coxa']) ? (float) $data['coxa'] : null,
            joelho: isset($data['joelho']) ? (float) $data['joelho'] : null,
            comprimentoCalca: isset($data['comprimento_calca']) ? (float) $data['comprimento_calca'] : null,
            bainha: isset($data['bainha']) ? (float) $data['bainha'] : null,
            ganchoFrente: isset($data['gancho_frente']) ? (float) $data['gancho_frente'] : null,
            ganchoAtras: isset($data['gancho_atras']) ? (float) $data['gancho_atras'] : null,
        );
    }

    /**
     * Convert to array for model update (snake_case keys).
     *
     * @return array
     */
    public function toModelArray(): array
    {
        return array_filter([
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
        ], fn($value) => $value !== null);
    }
}

