<?php

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method returns clientes with pagination.
     */
    public function test_index_returns_clientes_with_pagination(): void
    {
        // Create a user and cliente
        $user = User::factory()->create();
        $cliente = Cliente::factory()->create(['user_id' => $user->id]);

        // Make request to index
        $response = $this->get(route('clientes.index'));

        // Assert response is successful
        $response->assertStatus(200);

        // Assert inertia response contains clientes
        $response->assertInertia(function ($page) use ($cliente) {
            $page->has('clientes');
        });
    }

    /**
     * Test the index method returns empty when no clientes exist.
     */
    public function test_index_returns_empty_when_no_clientes(): void
    {
        // Make request to index without any clientes
        $response = $this->get(route('clientes.index'));

        // Assert response is successful
        $response->assertStatus(200);

        // Assert inertia response contains empty clientes
        $response->assertInertia(function ($page) {
            $page->has('clientes');
        });
    }

    /**
     * Test the index method returns multiple clientes with pagination.
     */
    public function test_index_returns_multiple_clientes(): void
    {
        // Create multiple users and clientes
        $users = User::factory()->count(5)->create();
        foreach ($users as $user) {
            Cliente::factory()->create(['user_id' => $user->id]);
        }

        // Make request to index
        $response = $this->get(route('clientes.index'));

        // Assert response is successful
        $response->assertStatus(200);

        // Assert inertia response contains clientes
        $response->assertInertia(function ($page) {
            $page->has('clientes');
        });
    }
}
