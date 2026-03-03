<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Requests\CreateEncomendaDTO;
use App\DTOs\Requests\UpdateEncomendaDTO;
use App\DTOs\Requests\AddItemEncomendaDTO;
use App\DTOs\Requests\UpdateItemEncomendaDTO;
use App\DTOs\Responses\EncomendaDTO;
use App\Http\Controllers\Controller;
use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use App\Services\EncomendaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    protected $encomendaService;

    public function __construct(EncomendaService $encomendaService)
    {
        $this->encomendaService = $encomendaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $encomendas = $this->encomendaService->getAllAsDTO();

        return response()->json([
            'success' => true,
            ...$encomendas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_encomenda' => 'nullable|date',
            'estado' => 'nullable|string',
            'total' => 'nullable|numeric',
            'observacoes' => 'nullable|string',
        ]);

        $dto = CreateEncomendaDTO::fromRequest($validated);
        $encomenda = $this->encomendaService->createEncomenda($dto);

        return response()->json([
            'success' => true,
            'message' => 'Encomenda criada com sucesso.',
            'data' => EncomendaDTO::fromModel($encomenda, false),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $encomenda = $this->encomendaService->getByIdAsDTO($id);

        if (!$encomenda) {
            return response()->json([
                'success' => false,
                'message' => 'Encomenda não encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $encomenda,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'data_encomenda' => 'nullable|date',
            'estado' => 'nullable|string',
            'total' => 'nullable|numeric',
            'observacoes' => 'nullable|string',
        ]);

        $dto = UpdateEncomendaDTO::fromRequest($validated);
        $encomenda = $this->encomendaService->updateEncomenda($id, $dto);

        if (!$encomenda) {
            return response()->json([
                'success' => false,
                'message' => 'Encomenda não encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Encomenda atualizada com sucesso.',
            'data' => EncomendaDTO::fromModel($encomenda),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $result = $this->encomendaService->deleteEncomenda($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Encomenda não encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Encomenda excluída com sucesso.',
        ]);
    }

    /**
     * Add an item to the encomenda.
     */
    public function addItem(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'tipo' => 'required|in:camisa,fato,casaco,calca,colete',
            'cliente_medidas_id' => 'nullable|exists:cliente_medidas,id',
            'estado' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'data_previsao' => 'nullable|date',
        ]);

        $encomenda = Encomenda::findOrFail($id);

        $dto = AddItemEncomendaDTO::fromRequest($validated);
        $itemData = $dto->toModelArray($encomenda->id);

        $item = ItemEncomenda::create($itemData);

        // If using default measurements, create the medida
        if (!empty($validated['cliente_medidas_id'])) {
            $item->createMedidaFromDefault();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item adicionado à encomenda com sucesso.',
            'data' => $item->load('medida'),
        ], 201);
    }

    /**
     * Update an item in the encomenda.
     */
    public function updateItem(Request $request, int $encomendaId, int $itemId): JsonResponse
    {
        $validated = $request->validate([
            'estado' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'data_envio' => 'nullable|date',
            'data_previsao' => 'nullable|date',
        ]);

        $dto = UpdateItemEncomendaDTO::fromRequest($validated);
        $item = ItemEncomenda::where('encomenda_id', $encomendaId)->findOrFail($itemId);
        $item->update($dto->toModelArray());

        return response()->json([
            'success' => true,
            'message' => 'Item atualizado com sucesso.',
            'data' => $item->load('medida'),
        ]);
    }

    /**
     * Remove an item from the encomenda.
     */
    public function removeItem(int $encomendaId, int $itemId): JsonResponse
    {
        $item = ItemEncomenda::where('encomenda_id', $encomendaId)->findOrFail($itemId);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removido da encomenda com sucesso.',
        ]);
    }

    /**
     * Get all items of an encomenda.
     */
    public function itens(int $id): JsonResponse
    {
        $encomenda = Encomenda::with(['itens.medida'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $encomenda->itens,
        ]);
    }
}

