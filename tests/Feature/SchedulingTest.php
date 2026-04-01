<?php
// ...existing code...
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\Cliente;
use App\Http\Controllers\Api\AgendamentoController;
use Illuminate\Http\Request;

class SchedulingTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_scheduling_triggers_whatsapp_confirmation()
    {
        $whatsClass = \App\Infrastructure\Services\WhatsApp\WhatsAppService::class;

        $whats = Mockery::mock($whatsClass);
        $whats->shouldReceive('sendSchedulingConfirmation')->once()->withArgs(function ($cliente, $data) {
            return $cliente instanceof \App\Models\Cliente && isset($data['date']);
        });
        $this->app->instance($whatsClass, $whats);

        $cliente = Cliente::factory()->create();

        $payload = [
            'cliente_id' => $cliente->id,
            'date' => now()->addDays(2)->toDateTimeString(),
            'notes' => 'Teste TDD'
        ];

        // chama controller diretamente para evitar dependência de rota
        $controller = $this->app->make(AgendamentoController::class);
        $request = new Request($payload);
        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
    }
}
