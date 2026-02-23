<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class ClienteService
{
    /**
     * Get all clientes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        $clientes = Cliente::with('user')->get();

        return $clientes->map(function ($cliente) {
            return [
                'id' => $cliente->id,
                'name' => $cliente->user->name ?? null,
                'email' => $cliente->user->email ?? null,
                'telefone' => $cliente->telefone,
                'user_id' => $cliente->user_id,
            ];
        });
    }

    /**
     * Get cliente by ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getById($id)
    {
        $cliente = Cliente::with('user')->find($id);

        if (!$cliente) {
            return null;
        }

        return [
            'id' => $cliente->id,
            'name' => $cliente->user->name ?? null,
            'email' => $cliente->user->email ?? null,
            'telefone' => $cliente->telefone,
            'user_id' => $cliente->user_id,
        ];
    }

    /**
     * Get cliente by user ID.
     *
     * @param int $userId
     * @return Cliente|null
     */
    public function getByUserId($userId)
    {
        return Cliente::where('user_id', $userId)->first();
    }

    /**
     * Create a new cliente.
     *
     * @param array $data
     * @return Cliente
     */
    public function create(array $data)
    {
        $data['user_id'] = $data['user_id'] ?? Auth::id();

        return Cliente::create($data);
    }

    /**
     * Update an existing cliente.
     *
     * @param int $id
     * @param array $data
     * @return Cliente|null
     */
    public function update($id, array $data)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return null;
        }

        $cliente->update($data);

        return $cliente->fresh();
    }

    /**
     * Delete a cliente.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return false;
        }

        return $cliente->delete();
    }
}
