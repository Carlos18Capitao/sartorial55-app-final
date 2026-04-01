<?php
// ...existing code...
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use App\Models\Encomenda;

class PaymentConfirmedTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_confirmed_dispatches_buy_fabric_job()
    {
        Bus::fake();

        $encomenda = Encomenda::factory()->create();

        event(new \App\Events\PagamentoConfirmado($encomenda));

        Bus::assertDispatched(\App\Jobs\ComprarTecidoJob::class, function ($job) use ($encomenda) {
            return isset($job->encomenda) ? $job->encomenda->id === $encomenda->id : true;
        });
    }
}
