<?php

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create a cliente with default medidas for testing
    $this->cliente = Cliente::factory()->create();
    $this->clienteMedidas = ClienteMedidas::factory()->create(['cliente_id' => $this->cliente->id]);
});

describe('Encomenda API', function () {
    describe('GET /api/encomendas', function () {
        it('returns all encomendas', function () {
            $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

            $response = $this->getJson('/api/encomendas');

            $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        '*' => [
                            'id',
                            'cliente_id',
                            'data_encomenda',
                            'estado',
                            'total',
                            'observacoes',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ]);
        });
    });

    describe('POST /api/encomendas', function () {
        it('creates a new encomenda', function () {
            $encomendaData = [
                'cliente_id' => $this->cliente->id,
                'data_encomenda' => '2026-01-15',
                'estado' => 'pendente',
                'total' => 150.00,
                'observacoes' => 'Test order',
            ];

            $response = $this->postJson('/api/encomendas', $encomendaData);

            $response->assertStatus(201)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'id',
                        'cliente_id',
                        'data_encomenda',
                        'estado',
                        'total',
                        'observacoes',
                    ],
                ]);

            $this->assertDatabaseHas('encomendas', [
                'cliente_id' => $this->cliente->id,
                'estado' => 'pendente',
            ]);
        });

        it('validates required cliente_id', function () {
            $response = $this->postJson('/api/encomendas', [
                'estado' => 'pendente',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['cliente_id']);
        });
    });

    describe('GET /api/encomendas/{id}', function () {
        it('returns a specific encomenda', function () {
            $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

            $response = $this->getJson("/api/encomendas/{$encomenda->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.id', $encomenda->id);
        });

        it('returns 404 for non-existent encomenda', function () {
            $response = $this->getJson('/api/encomendas/999');

            $response->assertStatus(404)
                ->assertJsonPath('success', false);
        });
    });

    describe('PUT /api/encomendas/{id}', function () {
        it('updates an encomenda', function () {
            $encomenda = Encomenda::factory()->create([
                'cliente_id' => $this->cliente->id,
                'estado' => 'pendente',
            ]);

            $response = $this->putJson("/api/encomendas/{$encomenda->id}", [
                'estado' => 'enviada',
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('data.estado', 'enviada');

            $this->assertDatabaseHas('encomendas', [
                'id' => $encomenda->id,
                'estado' => 'enviada',
            ]);
        });
    });

    describe('DELETE /api/encomendas/{id}', function () {
        it('deletes an encomenda', function () {
            $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

            $response = $this->deleteJson("/api/encomendas/{$encomenda->id}");

            $response->assertStatus(200)
                ->assertJsonPath('success', true);

            $this->assertDatabaseMissing('encomendas', [
                'id' => $encomenda->id,
            ]);
        });
    });

    describe('Item Management', function () {
        describe('GET /api/encomendas/{id}/itens', function () {
            it('returns all items of an encomenda', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);
                ItemEncomenda::factory()->count(3)->create(['encomenda_id' => $encomenda->id]);

                $response = $this->getJson("/api/encomendas/{$encomenda->id}/itens");

                $response->assertStatus(200)
                    ->assertJsonCount(3, 'data');
            });
        });

        describe('POST /api/encomendas/{id}/itens', function () {
            it('creates a new item without default medidas', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

                $response = $this->postJson("/api/encomendas/{$encomenda->id}/itens", [
                    'tipo' => 'camisa',
                    'estado' => 'pendente',
                ]);

                $response->assertStatus(201)
                    ->assertJsonPath('data.tipo', 'camisa');

                $this->assertDatabaseHas('item_encomendas', [
                    'encomenda_id' => $encomenda->id,
                    'tipo' => 'camisa',
                ]);
            });

            it('creates a new item with default medidas', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

                $response = $this->postJson("/api/encomendas/{$encomenda->id}/itens", [
                    'tipo' => 'camisa',
                    'cliente_medidas_id' => $this->clienteMedidas->id,
                    'estado' => 'pendente',
                ]);

                $response->assertStatus(201)
                    ->assertJsonPath('data.tipo', 'camisa');

                $this->assertDatabaseHas('item_encomendas', [
                    'encomenda_id' => $encomenda->id,
                    'tipo' => 'camisa',
                    'cliente_medidas_id' => $this->clienteMedidas->id,
                ]);
            });

            it('validates required tipo', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

                $response = $this->postJson("/api/encomendas/{$encomenda->id}/itens", []);

                $response->assertStatus(422)
                    ->assertJsonValidationErrors(['tipo']);
            });

            it('validates tipo value', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);

                $response = $this->postJson("/api/encomendas/{$encomenda->id}/itens", [
                    'tipo' => 'invalid_type',
                ]);

                $response->assertStatus(422)
                    ->assertJsonValidationErrors(['tipo']);
            });
        });

        describe('PUT /api/encomendas/{encomendaId}/itens/{itemId}', function () {
            it('updates an item', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);
                $item = ItemEncomenda::factory()->create([
                    'encomenda_id' => $encomenda->id,
                    'estado' => 'pendente',
                ]);

                $response = $this->putJson("/api/encomendas/{$encomenda->id}/itens/{$item->id}", [
                    'estado' => 'em_producao',
                ]);

                $response->assertStatus(200)
                    ->assertJsonPath('data.estado', 'em_producao');

                $this->assertDatabaseHas('item_encomendas', [
                    'id' => $item->id,
                    'estado' => 'em_producao',
                ]);
            });
        });

        describe('DELETE /api/encomendas/{encomendaId}/itens/{itemId}', function () {
            it('deletes an item', function () {
                $encomenda = Encomenda::factory()->create(['cliente_id' => $this->cliente->id]);
                $item = ItemEncomenda::factory()->create(['encomenda_id' => $encomenda->id]);

                $response = $this->deleteJson("/api/encomendas/{$encomenda->id}/itens/{$item->id}");

                $response->assertStatus(200)
                    ->assertJsonPath('success', true);

                $this->assertDatabaseMissing('item_encomendas', [
                    'id' => $item->id,
                ]);
            });
        });
    });
});

