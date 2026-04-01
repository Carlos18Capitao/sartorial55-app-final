<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\Encomenda;

class PaymentReminderTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_reminder_sends_whatsapp_for_overdue_orders()
    {
        $whatsClass = \App\Infrastructure\Services\WhatsApp\WhatsAppService::class;

        $whats = Mockery::mock($whatsClass);
        $whats->shouldReceive('sendPaymentReminder')->once()->withArgs(function ($cliente, $encomenda) {
            return $encomenda instanceof \App\Models\Encomenda;
        });
        $this->app->instance($whatsClass, $whats);

        // cria encomenda em AGUARDANDO_PAGAMENTO (não usar campo data_entrega inexistente)
        Encomenda::factory()->create([
            'estado' => 'AGUARDANDO_PAGAMENTO',
        ]);

        $svcClass = \App\Application\Services\PaymentReminderService::class;
        $svc = $this->app->make($svcClass);
        $svc->runDueReminders();
    }
}
