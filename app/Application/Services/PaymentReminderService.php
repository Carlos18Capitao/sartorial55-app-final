<?php
namespace App\Application\Services;

use App\Models\Encomenda;
use App\Infrastructure\Services\WhatsApp\WhatsAppService;

class PaymentReminderService
{
    /**
     * Executa lembretes para encomendas em AGUARDANDO_PAGAMENTO.
     * Minimal: busca encomendas e chama WhatsAppService.
     */
    public function runDueReminders(): void
    {
        $orders = Encomenda::where('estado', 'AGUARDANDO_PAGAMENTO')->get();

        /** @var WhatsAppService $whats */
        $whats = app(WhatsAppService::class);

        foreach ($orders as $order) {
            // assume relacionamento cliente em Encomenda: $order->cliente
            $cliente = $order->cliente ?? null;
            $whats->sendPaymentReminder($cliente, $order);
        }
    }
}
