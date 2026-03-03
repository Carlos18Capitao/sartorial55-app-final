<?php

namespace App\Services\Items;

use App\Models\ItemEncomenda;
use App\Models\ClienteMedidas;
use App\Models\MedidaCasaco;

class CasacoItemEncomendaService extends BaseItemEncomendaService
{
    /**
     * Get the item type.
     */
    public function getType(): string
    {
        return 'casaco';
    }

    /**
     * Create MedidaCasaco from default ClienteMedidas.
     */
    public function createMedidaFromDefault(ItemEncomenda $item, ClienteMedidas $defaultMedidas): ?ItemEncomenda
    {
        $medida = MedidaCasaco::create([
            'base' => $defaultMedidas->base,
            'distancia_ombro_botao' => $defaultMedidas->distancia_ombro_botao,
            'comprimento_manga' => $defaultMedidas->comprimento_manga_casaco,
            'bicep' => $defaultMedidas->bicep_casaco,
            'boca_manga' => $defaultMedidas->boca_manga,
            'meia_cinta' => $defaultMedidas->meia_cinta,
            'meio_ombro' => $defaultMedidas->meio_ombro,
            'meia_costa' => $defaultMedidas->meia_costa,
            'comprimento_costa' => $defaultMedidas->comprimento_costa,
            'comprimento_frente' => $defaultMedidas->comprimento_frente,
            'racha_lateral' => $defaultMedidas->racha_lateral_casaco,
        ]);

        $item->update([
            'medida_id' => $medida->id,
            'medida_type' => MedidaCasaco::class,
        ]);

        return $item->fresh('medida');
    }

    /**
     * Create a custom MedidaCasaco directly.
     */
    public function createMedida(array $data): MedidaCasaco
    {
        return MedidaCasaco::create([
            'base' => $data['base'] ?? null,
            'distancia_ombro_botao' => $data['distancia_ombro_botao'] ?? null,
            'comprimento_manga' => $data['comprimento_manga'] ?? null,
            'bicep' => $data['bicep'] ?? null,
            'boca_manga' => $data['boca_manga'] ?? null,
            'meia_cinta' => $data['meia_cinta'] ?? null,
            'meio_ombro' => $data['meio_ombro'] ?? null,
            'meia_costa' => $data['meia_costa'] ?? null,
            'comprimento_costa' => $data['comprimento_costa'] ?? null,
            'comprimento_frente' => $data['comprimento_frente'] ?? null,
            'racha_lateral' => $data['racha_lateral'] ?? null,
        ]);
    }
}
