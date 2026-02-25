<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\User;

class ClienteService
{
    /**
     * Get all clientes with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($perPage = 15)
    {
        $clientes = Cliente::with(['user', 'encomendas', 'medidas'])
            ->paginate($perPage);

        return $clientes->getCollection()->map(function ($cliente) {
            return [
                'id' => $cliente->id,
                'name' => $cliente->user->name ?? null,
                'email' => $cliente->user->email ?? null,
                'telefone' => $cliente->telefone,
                'user_id' => $cliente->user_id,
                'medidas' => $cliente->medidas ? [
                    // Medidas da Camisa
                    'colarinho' => $cliente->medidas->colarinho,
                    'ombro_ombro' => $cliente->medidas->ombro_ombro,
                    'peito' => $cliente->medidas->peito,
                    'cintura' => $cliente->medidas->cintura,
                    'anca' => $cliente->medidas->anca,
                    'bicep' => $cliente->medidas->bicep,
                    'comprimento_manga_direita' => $cliente->medidas->comprimento_manga_direita,
                    'comprimento_manga_esquerda' => $cliente->medidas->comprimento_manga_esquerda,
                    'comprimento_manga_curta' => $cliente->medidas->comprimento_manga_curta,
                    'punho_esquerdo' => $cliente->medidas->punho_esquerdo,
                    'punho_direito' => $cliente->medidas->punho_direito,
                    'comprimento_camisa' => $cliente->medidas->comprimento_camisa,
                    // Medidas do Casaco
                    'base' => $cliente->medidas->base,
                    'distancia_ombro_botao' => $cliente->medidas->distancia_ombro_botao,
                    'comprimento_manga_casaco' => $cliente->medidas->comprimento_manga_casaco,
                    'bicep_casaco' => $cliente->medidas->bicep_casaco,
                    'boca_manga' => $cliente->medidas->boca_manga,
                    'meia_cinta' => $cliente->medidas->meia_cinta,
                    'meio_ombro' => $cliente->medidas->meio_ombro,
                    'meia_costa' => $cliente->medidas->meia_costa,
                    'comprimento_costa' => $cliente->medidas->comprimento_costa,
                    'comprimento_frente' => $cliente->medidas->comprimento_frente,
                    'racha_lateral_casaco' => $cliente->medidas->racha_lateral_casaco,
                    // Medidas do Colete
                    'tamanho_colete' => $cliente->medidas->tamanho_colete,
                    'ombro_botao_colete' => $cliente->medidas->ombro_botao_colete,
                    'comprimento_frente_colete' => $cliente->medidas->comprimento_frente_colete,
                    'comprimento_costa_colete' => $cliente->medidas->comprimento_costa_colete,
                    'meia_cinta_colete' => $cliente->medidas->meia_cinta_colete,
                    // Medidas da Calça
                    'tamanho_calca' => $cliente->medidas->tamanho_calca,
                    'cintura_calca' => $cliente->medidas->cintura_calca,
                    'anca_calca' => $cliente->medidas->anca_calca,
                    'coxa' => $cliente->medidas->coxa,
                    'joelho' => $cliente->medidas->joelho,
                    'comprimento_calca' => $cliente->medidas->comprimento_calca,
                    'bainha' => $cliente->medidas->bainha,
                    'gancho_frente' => $cliente->medidas->gancho_frente,
                    'gancho_atras' => $cliente->medidas->gancho_atras,
                ] : null,
                'encomendas' => $cliente->encomendas->map(function ($encomenda) {
                    return [
                        'id' => $encomenda->id,
                        'data_encomenda' => $encomenda->data_encomenda,
                        'estado' => $encomenda->estado,
                        'total' => $encomenda->total,
                        'observacoes' => $encomenda->observacoes,
                        'itens' => $encomenda->itens->map(function ($item) {
                            $medida = null;
                            if ($item->medida_type && $item->medida_id) {
                                $medidaModel = $item->medida;
                                if ($medidaModel) {
                                    $medida = [
                                        'tipo' => $item->tipo,
                                        'tipo_model' => $item->medida_type,
                                        // Medidas da Camisa
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
                                        // Medidas do Casaco
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
                                        // Medidas do Colete
                                        'tamanho' => $medidaModel->tamanho ?? null,
                                        'ombro_botao' => $medidaModel->ombro_botao ?? null,
                                        'comprimento_frente_colete' => $medidaModel->comprimento_frente ?? null,
                                        'comprimento_costa_colete' => $medidaModel->comprimento_costa ?? null,
                                        'meia_cinta_colete' => $medidaModel->meia_cinta ?? null,
                                        // Medidas da Calça
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
                                'data_envio' => $item->data_envio,
                                'data_previsao' => $item->data_previsao,
                                'medida' => $medida,
                            ];
                        }),
                    ];
                }),
            ];
        });
    }

    /**
     * Get cliente by ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getById($id)
    {
        $cliente = Cliente::with(['user', 'encomendas', 'medidas'])->find($id);

        if (!$cliente) {
            return null;
        }

        return [
            'id' => $cliente->id,
            'name' => $cliente->user->name ?? null,
            'email' => $cliente->user->email ?? null,
            'telefone' => $cliente->telefone,
            'user_id' => $cliente->user_id,
            'medidas' => $cliente->medidas ? [
                // Medidas da Camisa
                'colarinho' => $cliente->medidas->colarinho,
                'ombro_ombro' => $cliente->medidas->ombro_ombro,
                'peito' => $cliente->medidas->peito,
                'cintura' => $cliente->medidas->cintura,
                'anca' => $cliente->medidas->anca,
                'bicep' => $cliente->medidas->bicep,
                'comprimento_manga_direita' => $cliente->medidas->comprimento_manga_direita,
                'comprimento_manga_esquerda' => $cliente->medidas->comprimento_manga_esquerda,
                'comprimento_manga_curta' => $cliente->medidas->comprimento_manga_curta,
                'punho_esquerdo' => $cliente->medidas->punho_esquerdo,
                'punho_direito' => $cliente->medidas->punho_direito,
                'comprimento_camisa' => $cliente->medidas->comprimento_camisa,
                // Medidas do Casaco
                'base' => $cliente->medidas->base,
                'distancia_ombro_botao' => $cliente->medidas->distancia_ombro_botao,
                'comprimento_manga_casaco' => $cliente->medidas->comprimento_manga_casaco,
                'bicep_casaco' => $cliente->medidas->bicep_casaco,
                'boca_manga' => $cliente->medidas->boca_manga,
                'meia_cinta' => $cliente->medidas->meia_cinta,
                'meio_ombro' => $cliente->medidas->meio_ombro,
                'meia_costa' => $cliente->medidas->meia_costa,
                'comprimento_costa' => $cliente->medidas->comprimento_costa,
                'comprimento_frente' => $cliente->medidas->comprimento_frente,
                'racha_lateral_casaco' => $cliente->medidas->racha_lateral_casaco,
                // Medidas do Colete
                'tamanho_colete' => $cliente->medidas->tamanho_colete,
                'ombro_botao_colete' => $cliente->medidas->ombro_botao_colete,
                'comprimento_frente_colete' => $cliente->medidas->comprimento_frente_colete,
                'comprimento_costa_colete' => $cliente->medidas->comprimento_costa_colete,
                'meia_cinta_colete' => $cliente->medidas->meia_cinta_colete,
                // Medidas da Calça
                'tamanho_calca' => $cliente->medidas->tamanho_calca,
                'cintura_calca' => $cliente->medidas->cintura_calca,
                'anca_calca' => $cliente->medidas->anca_calca,
                'coxa' => $cliente->medidas->coxa,
                'joelho' => $cliente->medidas->joelho,
                'comprimento_calca' => $cliente->medidas->comprimento_calca,
                'bainha' => $cliente->medidas->bainha,
                'gancho_frente' => $cliente->medidas->gancho_frente,
                'gancho_atras' => $cliente->medidas->gancho_atras,
            ] : null,
            'encomendas' => $cliente->encomendas->map(function ($encomenda) {
                return [
                    'id' => $encomenda->id,
                    'data_encomenda' => $encomenda->data_encomenda,
                    'estado' => $encomenda->estado,
                    'total' => $encomenda->total,
                    'observacoes' => $encomenda->observacoes,
                    'itens' => $encomenda->itens->map(function ($item) {
                        $medida = null;
                        if ($item->medida_type && $item->medida_id) {
                            $medidaModel = $item->medida;
                            if ($medidaModel) {
                                $medida = [
                                    'tipo' => $item->tipo,
                                    'tipo_model' => $item->medida_type,
                                    // Medidas da Camisa
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
                                    // Medidas do Casaco
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
                                    // Medidas do Colete
                                    'tamanho' => $medidaModel->tamanho ?? null,
                                    'ombro_botao' => $medidaModel->ombro_botao ?? null,
                                    'comprimento_frente_colete' => $medidaModel->comprimento_frente ?? null,
                                    'comprimento_costa_colete' => $medidaModel->comprimento_costa ?? null,
                                    'meia_cinta_colete' => $medidaModel->meia_cinta ?? null,
                                    // Medidas da Calça
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
                            'data_envio' => $item->data_envio,
                            'data_previsao' => $item->data_previsao,
                            'medida' => $medida,
                        ];
                    }),
                ];
            }),
        ];
    }

    /**
     * Get cliente by user ID.
     *
     * @param int $userId
     * @return Cliente|null
     */
    public function getByUserId($userId)
    {
        return Cliente::where('user_id', $userId)->first();
    }

    /**
     * Create a new cliente.
     *
     * @param array $data
     * @return Cliente
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['user']['name'] ?? null,
            'email' => $data['user']['email'] ?? null,
            'password' => isset($data['user']['password']) ? bcrypt($data['user']['password']) : null,
        ]);

        $data['user_id'] = $user->id;

        return Cliente::create($data);
    }

    /**
     * Update an existing cliente.
     *
     * @param int $id
     * @param array $data
     * @return Cliente|null
     */
    public function update($id, array $data)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return null;
        }

        $cliente->update($data);

        return $cliente->fresh();
    }

    /**
     * Update or create cliente medidas.
     *
     * @param int $clienteId
     * @param array $medidasData
     * @return ClienteMedidas
     */
    public function updateMedidas($clienteId, array $medidasData)
    {
        return ClienteMedidas::updateOrCreate(
            ['cliente_id' => $clienteId],
            $medidasData
        );
    }

    /**
     * Delete a cliente.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return false;
        }

        return $cliente->delete();
    }
}
