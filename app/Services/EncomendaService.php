<?php

namespace App\Services;
use App\Repositories\ClientEloquenteORM;
use App\Repositories\EncomendaEloquentORM;
use App\Repositories\ItemEloquentORM;
use App\Repositories\CasacoEloquenteORM;
use App\Models\Encomenda;
use App\Models\Item;

class EncomendaService {

    public function __construct(
        public ClientEloquenteORM $clientRepo,
        public EncomendaEloquentORM $encomendaRepo,
        public ItemEloquentORM $itemRepo,
        public CasacoEloquenteORM $casacoRepo
    ) {}

    public function encomenda(array $data): Encomenda
    {
        // Criar a encomenda
        $encomendaData = [
            'cliente_id' => $data['cliente_id'],
            'numero' => $data['numero'] ?? 'ENC-' . now()->format('dmYHis'),
            'data' => $data['data'] ?? now()->toDateString(),
            'status' => $data['status'] ?? 'Pendente',
            'observacao' => $data['observacao'] ?? null,
        ];

        $encomenda = Encomenda::create($encomendaData);

        // Criar os itens
        foreach ($data['itens'] as $itemData) {
            $tipo = $itemData['tipo'];
            $dados = $itemData['dados'];
            $quantidade = $itemData['quantidade'] ?? 1;
            $descricao = $itemData['descricao'] ?? null;

            // Criar o itemable baseado no tipo
            $itemable = null;
            switch ($tipo) {
                case 'casaco':
                    $itemable = $this->casacoRepo->newItem($dados);
                    break;
                // Adicionar outros tipos conforme necessário
                default:
                    throw new \Exception("Tipo de item '{$tipo}' não suportado");
            }

            // Criar o Item
            Item::create([
                'encomenda_id' => $encomenda->id,
                'itemable_type' => get_class($itemable),
                'itemable_id' => $itemable->id,
                'quantidade' => $quantidade,
                'descricao' => $descricao,
                'status' => 'Pendente',
            ]);
        }

        return $encomenda->load(['itens.itemable']);
    }
}
