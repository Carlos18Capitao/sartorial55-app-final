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
        return Cliente::with('user')->get();
    }

    /**
     * Get cliente by ID.
     *
     * @param int $id
     * @return Cliente|null
     */
    public function getById($id)
    {
        return Cliente::with('user')->find($id);
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
