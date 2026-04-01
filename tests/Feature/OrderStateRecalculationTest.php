<?php
// ...existing code...
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use App\Services\EncomendaService;

class OrderStateRecalculationTest extends TestCase
{
    use RefreshDatabase;

    public function test_recalculate_order_state_based_on_items()
    {
        $encomenda = Encomenda::factory()->create();

        ItemEncomenda::factory()->create([
            'encomenda_id' => $encomenda->id,
            'estado' => 'ENTREGUE'
        ]);

        ItemEncomenda::factory()->create([
            'encomenda_id' => $encomenda->id,
            'estado' => 'EM_PRODUCAO'
        ]);

        // Serviço de domínio esperado (implementa recálculo)
        $service = $this->app->make(EncomendaService::class);
        $service->recalculateState($encomenda);

        $encomenda->refresh();
        $this->assertEquals('EM_PRODUCAO', $encomenda->estado);
    }
}
