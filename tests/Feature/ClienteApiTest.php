<?php

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create a user for authentication
    $this->user = User::factory()->create();
});

describe('Cliente API', function () {
    describe('GET /api/clientes', function () {
        it('returns all clientes', function () {
            Cliente::factory()->count(3)->create();

            $response = $this->getJson('/api/clientes');

            $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
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
    });

    describe('POST /api/clientes', function () {
        it('creates a new cliente with user', function () {
            $response = $this->postJson('/api/clientes', [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => 'password123',
                ],
                'telefone' => '912345678',
            ]);

            $response->assertStatus(201)
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
        });

        it('validates required user data', function () {
            $response = $this->postJson('/api/clientes', [
                'telefone' => '912345678',
            ]);

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['user.name', 'user.email']);
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
    });

    describe('GET /api/clientes/{id}', function () {
        it('returns a specific cliente', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->getJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.id', $cliente->id);
        });

        it('returns 404 for non-existent cliente', function () {
            $response = $this->getJson('/api/clientes/999');

            $response->assertStatus(404)
                ->assertJsonPath('success', false);
        });
    });

    describe('PUT /api/clientes/{id}', function () {
        it('updates a cliente', function () {
            $cliente = Cliente::factory()->create([
                'telefone' => '912345678',
            ]);

            $response = $this->putJson("/api/clientes/{$cliente->id}", [
                'telefone' => '999999999',
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('data.telefone', '999999999');

            $this->assertDatabaseHas('clientes', [
                'id' => $cliente->id,
                'telefone' => '999999999',
            ]);
        });
    });

    describe('PUT /api/clientes/{id}/medidas', function () {
        it('updates cliente medidas', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->putJson("/api/clientes/{$cliente->id}/medidas", [
                'colarinho' => 40,
                'ombro_ombro' => 45,
                'peito' => 100,
                'cintura' => 85,
                'anca' => 95,
            ]);

            $response->assertStatus(200)
                ->assertJsonPath('success', true);

            $this->assertDatabaseHas('cliente_medidas', [
                'cliente_id' => $cliente->id,
                'colarinho' => 40,
                'ombro_ombro' => 45,
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

            $response->assertStatus(200);
            $this->assertDatabaseHas('cliente_medidas', [
                'cliente_id' => $cliente->id,
                'colarinho' => 40,
            ]);
        });
    });

    describe('DELETE /api/clientes/{id}', function () {
        it('deletes a cliente', function () {
            $cliente = Cliente::factory()->create();

            $response = $this->deleteJson("/api/clientes/{$cliente->id}");

            $response->assertStatus(200)
                ->assertJsonPath('success', true);

            $this->assertDatabaseMissing('clientes', [
                'id' => $cliente->id,
            ]);
        });

        it('returns 404 for non-existent cliente', function () {
            $response = $this->deleteJson('/api/clientes/999');

            $response->assertStatus(404)
                ->assertJsonPath('success', false);
        });
    });
});

