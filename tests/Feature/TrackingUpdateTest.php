<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use App\Models\ItemEncomenda;
use App\Events\TrackingAtualizado;
use App\Jobs\EnviarParaFabricaJob;

class TrackingUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_tracking_delivered_updates_item_and_dispatches_send_to_factory()
    {
        Bus::fake();

        $item = ItemEncomenda::factory()->create([
            'estado' => 'TECIDO_EM_TRANSITO'
        ]);

        $tracking = (object)[
            'item_encomenda_id' => $item->id,
            'status' => 'in_transit',
            'tracking_code' => 'TRACK123'
        ];

        event(new TrackingAtualizado($tracking, 'delivered'));

        $item->refresh();
        $this->assertEquals('TECIDO_RECEBIDO', $item->estado);

        Bus::assertDispatched(EnviarParaFabricaJob::class, function ($job) use ($item) {
            return isset($job->itemEncomenda) && $job->itemEncomenda->id === $item->id;
        });
    }
}
