<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\User;

class ClienteService
{
    /**
     * Get all clientes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        $clientes = Cliente::with(['user', 'encomendas'])->get();

        return $clientes->map(function ($cliente) {
            return [
                'id' => $cliente->id,
                'name' => $cliente->user->name ?? null,
                'email' => $cliente->user->email ?? null,
                'telefone' => $cliente->telefone,
                'user_id' => $cliente->user_id,
                'encomendas' => $cliente->encomendas->map(function ($encomenda) {
                    return [
                        'id' => $encomenda->id,
                        'data_encomenda' => $encomenda->data_encomenda,
                        'estado' => $encomenda->estado,
                        'total' => $encomenda->total,
                        'observacoes' => $encomenda->observacoes,
                    ];
                }),
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
        $cliente = Cliente::with(['user', 'encomendas'])->find($id);

        if (!$cliente) {
            return null;
        }

        return [
            'id' => $cliente->id,
            'name' => $cliente->user->name ?? null,
            'email' => $cliente->user->email ?? null,
            'telefone' => $cliente->telefone,
            'user_id' => $cliente->user_id,
            'encomendas' => $cliente->encomendas->map(function ($encomenda) {
                return [
                    'id' => $encomenda->id,
                    'data_encomenda' => $encomenda->data_encomenda,
                    'estado' => $encomenda->estado,
                    'total' => $encomenda->total,
                    'observacoes' => $encomenda->observacoes,
                ];
            }),
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
        $user = User::create([
            'name' => $data['user']['name'] ?? null,
            'email' => $data['user']['email'] ?? null,
            'password' => isset($data['user']['password']) ? bcrypt($data['user']['password']) : null,
        ]);

        $data['user_id'] = $user->id;

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
