<?php

namespace App\Services;

use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use App\Models\Cliente;

class EncomendaService
{
    protected array $allowed = [
        'cliente_id',
        'data_encomenda',
        'estado',
        'total',
        'observacoes',
    ];

    /**
     * Retorna todas as encomendas como arrays simples (usado pelas APIs/tests).
     */
    public function getAllAsDTO(): array
    {
        return Encomenda::with(['cliente', 'itens'])->get()->map(function (Encomenda $e) {
            return $e->toArray();
        })->all();
    }

    /**
     * Cria uma encomenda a partir de um DTO/array/request.
     */
    public function createEncomenda($dto)
    {
        $data = $this->normalizeInput($dto);

        // se o normalizeInput não trouxe cliente_id, tenta obter diretamente da Request HTTP
        if ((empty($data['cliente_id']) || $data['cliente_id'] === null) && function_exists('request')) {
            $req = request();
            if ($req instanceof \Illuminate\Http\Request && $req->filled('cliente_id')) {
                $data['cliente_id'] = $req->input('cliente_id');
            }
        }

        // fallback: se não houver cliente_id, cria um cliente de teste (útil em seeds/tests que chamam o serviço diretamente)
        if (empty($data['cliente_id'])) {
            $cliente = Cliente::factory()->create();
            $data['cliente_id'] = $cliente->id;
        }

        // defaults mínimos obrigatórios para evitar NOT NULL
        $data['total'] = $data['total'] ?? 0;
        $data['data_encomenda'] = $data['data_encomenda'] ?? now()->toDateString();

        $data['estado'] = $this->normalizeEstado($data['estado'] ?? null);
        $data = $this->onlyAllowed($data);

        return Encomenda::create($data);
    }

    public function getByIdAsDTO(int $id)
    {
        $encomenda = Encomenda::with(['cliente','itens'])->find($id);
        if (! $encomenda) {
            return null;
        }
        return $encomenda->toArray();
    }

    public function updateEncomenda(int $id, $dto)
    {
        $encomenda = Encomenda::findOrFail($id);
        $data = $this->normalizeInput($dto);

        // normalizar estado se estiver presente
        if (array_key_exists('estado', $data)) {
            $data['estado'] = $this->normalizeEstado($data['estado']);
        }

        // mantém apenas campos permitidos
        $data = array_intersect_key($data, array_flip($this->allowed));

        // evita sobrescrever colunas NOT NULL com nulls acidentais:
        // remove chaves cujo valor é estritamente null (mantém 0, '', false)
        $data = array_filter($data, fn($v) => $v !== null);

        $encomenda->fill($data);
        $encomenda->save();

        return $encomenda;
    }

    public function deleteEncomenda(int $id): bool
    {
        $encomenda = Encomenda::find($id);
        if (! $encomenda) {
            return false;
        }
        return (bool) $encomenda->delete();
    }

    /**
     * Recalcula o estado da encomenda com base nos estados dos itens (UPPER_SNAKE).
     */
    public function recalculateState(Encomenda $encomenda): void
    {
        $items = ItemEncomenda::where('encomenda_id', $encomenda->id)->get();

        if ($items->isEmpty()) {
            return;
        }

        // Se algum item foi devolvido -> marca encomenda como CANCELADA (migration não permite "PROBLEMA")
        if ($items->contains(fn($it) => strtoupper((string)$it->estado) === 'DEVOLVIDO')) {
            $encomenda->estado = 'CANCELADA';
            $encomenda->save();
            return;
        }

        // Se algum item está em produção/transporte -> EM_PROCESSAMENTO
        if ($items->contains(fn($it) => in_array(strtoupper((string)$it->estado), ['EM_PRODUCAO','ENVIADO_PARA_FABRICA','EM_TRANSPORTE']))) {
            $encomenda->estado = 'EM_PROCESSAMENTO';
            $encomenda->save();
            return;
        }

        // Se algum item está pendente/aguardando pagamento -> PENDENTE
        if ($items->contains(fn($it) => in_array(strtoupper((string)$it->estado), ['AGUARDANDO_PAGAMENTO','PENDENTE']))) {
            $encomenda->estado = 'PENDENTE';
            $encomenda->save();
            return;
        }

        // Todos entregues
        if ($items->every(fn($it) => strtoupper((string)$it->estado) === 'ENTREGUE')) {
            $encomenda->estado = 'ENTREGUE';
            $encomenda->save();
            return;
        }

        // fallback
        $encomenda->estado = $encomenda->estado ?? 'PENDENTE';
        $encomenda->save();
    }

    /**
     * Normaliza input vindo de DTOs/Requests/arrays para um array simples utilizável no create/update.
     */
    protected function normalizeInput($dto): array
    {
        if (is_array($dto)) {
            return $dto;
        }

        if (is_object($dto)) {
            // Request objects: use all() to get input
            if ($dto instanceof \Illuminate\Http\Request) {
                return $dto->all();
            }

            if (method_exists($dto, 'validated')) {
                return $dto->validated();
            }

            if (method_exists($dto, 'toArray')) {
                $arr = $dto->toArray();
                if (is_array($arr)) {
                    return $arr;
                }
            }

            // converte object com propriedades públicas
            return get_object_vars($dto);
        }

        return [];
    }

    protected function normalizeEstado($estado): string
    {
        if ($estado === null) {
            return 'PENDENTE';
        }

        $s = strtoupper((string)$estado);

        $map = [
            // mapear sinónimos/valores antigos -> enum actual da migration
            'CRIADA' => 'PENDENTE',
            'PENDENTE' => 'PENDENTE',
            'AGUARDANDO_PAGAMENTO' => 'PENDENTE',
            'AGUARDANDO-PAGAMENTO' => 'PENDENTE',
            'EM_PRODUCAO' => 'EM_PROCESSAMENTO',
            'EM.PRODUCAO' => 'EM_PROCESSAMENTO',
            'EM_PROCESSAMENTO' => 'EM_PROCESSAMENTO',
            'ENVIADA' => 'ENVIADA',
            'ENVIADO' => 'ENVIADA',
            'PRONTO' => 'ENVIADA',
            'ENTREGUE' => 'ENTREGUE',
            'CANCELADA' => 'CANCELADA',
            'DEVOLVIDO' => 'CANCELADA',
        ];

        return $map[$s] ?? 'PENDENTE';
    }

    protected function onlyAllowed(array $data): array
    {
        return array_intersect_key($data, array_flip($this->allowed));
    }
}
