<?php

namespace App\Events;

use App\Jobs\ComprarTecidoJob;

class PagamentoConfirmado
{
    public $payload;

    public function __construct($payload)
    {
        // $payload pode ser um modelo Pagamento ou Encomenda dependendo do teu fluxo
        $this->payload = $payload;

        // Dispatch do job de compra de tecido se não for pagamento parcial.
        // Verifica possíveis campos comuns (is_partial, parcial, amount_paid, total_amount).
        $isPartial = false;
        if (is_object($payload)) {
            if (property_exists($payload, 'is_partial')) {
                $isPartial = (bool) $payload->is_partial;
            } elseif (property_exists($payload, 'parcial')) {
                $isPartial = (bool) $payload->parcial;
            } elseif (isset($payload->is_partial)) {
                $isPartial = (bool) $payload->is_partial;
            }
        }

        if (! $isPartial) {
            // disparar o job (Bus::fake irá capturar)
            ComprarTecidoJob::dispatch($this->payload);
        }
    }
}
