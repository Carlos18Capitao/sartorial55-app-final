<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $clientes = $this->clienteService->getAll();

        return response()->json([
            'success' => true,
            'data' => $clientes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request): JsonResponse
    {
        $cliente = $this->clienteService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Cliente criado com sucesso.',
            'data' => $cliente,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $cliente = $this->clienteService->getById($id);

        if (!$cliente) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cliente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, int $id): JsonResponse
    {
        $cliente = $this->clienteService->update($id, $request->validated());

        if (!$cliente) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cliente atualizado com sucesso.',
            'data' => $cliente,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $result = $this->clienteService->delete($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cliente excluído com sucesso.',
        ]);
    }
}

