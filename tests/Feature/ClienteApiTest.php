<?php

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\User;

beforeEach(function () {
    // No authenticated user needed for API tests (no auth middleware)
});

describe('Cliente API', function () {
    describe('GET /api/clientes', function () {
        it('returns all clientes with pagination', function () {
            Cliente::factory()->count(3)->create();

            $response = $this->getJson('/api/clientes');

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonStructure([
                    'success',
                    'current_page',
                    'data' => [
                        '*' => [
                            'id',
                            'user_id',
                            'name',
                            'email',
                            'telefone',
                            'medidas',
                            'encomendas',
                        ],
                    ],
                ]);
        });

        it('returns empty data when no clientes exist', function () {
            $response = $this->getJson('/api/clientes');

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonCount(0, 'data');
        });

        it('includes user relationship data', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->getJson('/api/clientes');

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', $cliente->user->name)
                ->assertJsonPath('data.0.email', $cliente->user->email);
        });
    });

    describe('POST /api/clientes', function () {
        it('creates a new cliente with user', function () {
            $clienteData = [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => 'password123',
                ],
                'telefone' => '912345678',
            ];

            $response = $this->postJson('/api/clientes', $clienteData);

            $response->assertStatus(201)
                ->assertJsonPath('success', true)
                ->assertJsonPath('message', 'Cliente criado com sucesso.')
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'id',
                        'user_id',
                        'telefone',
                    ],
                ]);

            $this->assertDatabaseHas('clientes', [
                'telefone' => '912345678',
            ]);

            $this->assertDatabaseHas('users', [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ]);
        });

        it('creates a cliente without password (optional)', function () {
            $clienteData = [
                'user' => [
                    'name' => 'Jane Doe',
                    'email' => 'jane@example.com',
                ],
                'telefone' => '912345679',
            ];

            $response = $this->postJson('/api/clientes', $clienteData);

            $response->assertStatus(201)
                ->assertJsonPath('success', true);

            $this->assertDatabaseHas('users', [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
            ]);
        });

        it('validates required user.name', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'email' => 'test@example.com',
                    'password' => 'password123',
                ],
                'telefone' => '912345678',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['user.name']);
        });

        it('validates required user.email', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'Test User',
                    'password' => 'password123',
                ],
                'telefone' => '912345678',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['user.email']);
        });

        it('validates required telefone', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => 'password123',
                ],
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['telefone']);
        });

        it('validates unique email', function () {
            // Create existing user
            User::factory()->create(['email' => 'existing@example.com']);

            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'existing@example.com',
                    'password' => 'password123',
                ],
                'telefone' => '912345678',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['user.email']);
        });

        it('validates valid email format', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'invalid-email',
                    'password' => 'password123',
                ],
                'telefone' => '912345678',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['user.email']);
        });

        it('validates password minimum length when provided', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => 'short',
                ],
                'telefone' => '912345678',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['user.password']);
        });

        it('validates telefone maximum length', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => 'password123',
                ],
                'telefone' => str_repeat('9', 25),
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['telefone']);
        });
    });

    describe('GET /api/clientes/{id}', function () {
        it('returns a specific cliente', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->getJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonPath('data.id', $cliente->id)
                ->assertJsonPath('data.telefone', $cliente->telefone);
        });

        it('returns cliente with user data', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->getJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.name', $cliente->user->name)
                ->assertJsonPath('data.email', $cliente->user->email);
        });

        it('returns cliente with medidas when available', function () {
            $cliente = Cliente::factory()->create();
            ClienteMedidas::factory()->create(['cliente_id' => $cliente->id]);

            $response = $this->getJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'id',
                        'user_id',
                        'name',
                        'email',
                        'telefone',
                        'medidas' => [
                            'colarinho',
                            'ombro_ombro',
                            'peito',
                        ],
                        'encomendas',
                    ],
                ]);
        });

        it('returns 404 for non-existent cliente', function () {
            $response = $this->getJson('/api/clientes/999');

            $response->assertStatus(404)
                ->assertJsonPath('success', false)
                ->assertJsonPath('message', 'Cliente não encontrado.');
        });
    });

    describe('PUT /api/clientes/{id}', function () {
        it('updates a cliente telefone', function () {
            $cliente = Cliente::factory()->create([
                'telefone' => '912345678',
            ]);

            $response = $this->putJson("/api/clientes/{$cliente->id}", [
                'telefone' => '999999999',
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonPath('message', 'Cliente atualizado com sucesso.')
                ->assertJsonPath('data.telefone', '999999999');

            $this->assertDatabaseHas('clientes', [
                'id' => $cliente->id,
                'telefone' => '999999999',
            ]);
        });

        it('returns 404 when updating non-existent cliente', function () {
            $response = $this->putJson('/api/clientes/999', [
                'telefone' => '912345678',
            ]);

            $response->assertStatus(404)
                ->assertJsonPath('success', false)
                ->assertJsonPath('message', 'Cliente não encontrado.');
        });

        it('validates required telefone on update', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->putJson("/api/clientes/{$cliente->id}", []);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['telefone']);
        });

        it('validates telefone format on update', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->putJson("/api/clientes/{$cliente->id}", [
                'telefone' => str_repeat('9', 25),
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['telefone']);
        });
    });

    describe('PUT /api/clientes/{id}/medidas', function () {
        it('updates cliente medidas', function () {
            $cliente = Cliente::factory()->create();

            $medidasData = [
                'colarinho' => 40,
                'ombro_ombro' => 45,
                'peito' => 100,
                'cintura' => 85,
                'anca' => 95,
            ];

            $response = $this->putJson("/api/clientes/{$cliente->id}/medidas", $medidasData);

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonPath('message', 'Medidas atualizadas com sucesso.');

            $this->assertDatabaseHas('cliente_medidas', [
                'cliente_id' => $cliente->id,
                'colarinho' => 40,
                'ombro_ombro' => 45,
                'peito' => 100,
                'cintura' => 85,
                'anca' => 95,
            ]);
        });

        it('creates medidas if not exists', function () {
            $cliente = Cliente::factory()->create();

            // Ensure no medidas exist
            $this->assertDatabaseMissing('cliente_medidas', [
                'cliente_id' => $cliente->id,
            ]);

            $response = $this->putJson("/api/clientes/{$cliente->id}/medidas", [
                'colarinho' => 40,
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('success', true);

            $this->assertDatabaseHas('cliente_medidas', [
                'cliente_id' => $cliente->id,
                'colarinho' => 40,
            ]);
        });

        it('updates existing medidas', function () {
            $cliente = Cliente::factory()->create();
            $medidas = ClienteMedidas::factory()->create([
                'cliente_id' => $cliente->id,
                'colarinho' => 38,
            ]);

            $response = $this->putJson("/api/clientes/{$cliente->id}/medidas", [
                'colarinho' => 42,
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('success', true);

            $this->assertDatabaseHas('cliente_medidas', [
                'cliente_id' => $cliente->id,
                'colarinho' => 42,
            ]);
        });

        it('accepts partial medidas update', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->putJson("/api/clientes/{$cliente->id}/medidas", [
                'colarinho' => 40,
                'peito' => 100,
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('success', true);
        });
    });

    describe('DELETE /api/clientes/{id}', function () {
        it('deletes a cliente', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->deleteJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('success', true)
                ->assertJsonPath('message', 'Cliente excluído com sucesso.');

            $this->assertDatabaseMissing('clientes', [
                'id' => $cliente->id,
            ]);
        });

        it('returns 404 for non-existent cliente', function () {
            $response = $this->deleteJson('/api/clientes/999');

            $response->assertStatus(404)
                ->assertJsonPath('success', false)
                ->assertJsonPath('message', 'Cliente não encontrado.');
        });
    });

    describe('Response Structure', function () {
        it('index returns correct pagination structure', function () {
            Cliente::factory()->count(5)->create();

            $response = $this->getJson('/api/clientes');

            $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'current_page',
                    'data',
                    'first_page_url',
                    'from',
                    'last_page',
                    'last_page_url',
                    'links',
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to',
                    'total',
                ]);
        });

        it('show returns cliente with empty encomendas when none exist', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->getJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.encomendas', []);
        });
    });
});

