<?php

namespace App\Infrastructure\Services\WhatsApp;

class WhatsAppService
{
    /**
     * Envia confirmação de agendamento.
     * Stub: não faz chamadas reais.
     */
    public function sendSchedulingConfirmation($cliente, array $data): void
    {
        // stub: no-op or log
        // logger()->info('sendSchedulingConfirmation', ['cliente_id' => $cliente->id ?? null, 'data' => $data]);
    }

    /**
     * Envia lembrete de pagamento.
     */
    public function sendPaymentReminder($cliente, $encomenda): void
    {
        // stub
        // logger()->info('sendPaymentReminder', ['cliente_id' => $cliente->id ?? null, 'encomenda_id' => $encomenda->id ?? null]);
    }

    /**
     * Envia mensagem genérica.
     */
    public function sendMessage($cliente, string $message): void
    {
        // stub
        // logger()->info('sendMessage', ['cliente_id' => $cliente->id ?? null, 'message' => $message]);
    }
}
