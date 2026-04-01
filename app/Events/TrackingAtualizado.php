<?php

namespace App\Events;

use App\Models\ItemEncomenda;
use App\Jobs\EnviarParaFabricaJob;

class TrackingAtualizado
{
    public $tracking;
    public $status;

    public function __construct($tracking, string $status)
    {
        $this->tracking = $tracking;
        $this->status = $status;

        // Atualiza item associado e dispara envio para fábrica quando entregue
        $itemId = $tracking->item_encomenda_id ?? $tracking->item_id ?? null;

        if ($itemId) {
            $item = ItemEncomenda::find($itemId);
            if ($item) {
                // Normalizar alguns status possíveis
                $s = strtolower($status);
                if (in_array($s, ['delivered', 'delivered_to_receiver', 'entregue', 'delivered'])) {
                    $item->estado = 'TECIDO_RECEBIDO';
                    $item->save();

                    // Dispara job para enviar à fábrica
                    EnviarParaFabricaJob::dispatch($item);
                } else {
                    // Atualização simples de tracking -> optativo
                    // Não altera estado para outros status por enquanto
                }
            }
        }
    }
}
