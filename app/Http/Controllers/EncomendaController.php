<?php

namespace App\Http\Controllers;

use App\Application\Requests\AddItemEncomendaDTO;
use App\Application\DTOs\Requests\UpdateItemEncomendaDTO;
use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use App\Services\EncomendaService;

class EncomendaController extends Controller
{
    public function __construct(public EncomendaService $encomendaService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('encomenda/Index', [
            'encomendas' => $this->encomendaService->getAllAsDTO()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->encomendaService->deleteEncomenda($id);
        return redirect()->route('encomendas.index')->with('success', 'Encomenda eliminada com sucesso!');
    }

     /**
     * Add an item to the encomenda.
     */
    public function addItem(Request $request, int $id)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:camisa,fato,casaco,calca,colete',
            'cliente_medidas_id' => 'nullable|exists:cliente_medidas,id',
            'estado' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'data_previsao' => 'nullable|date',
        ]);

        $encomenda = Encomenda::findOrFail($id);

        $dto = \App\Application\DTOs\Requests\AddItemEncomendaDTO::fromRequest($validated);
        $itemData = $dto->toModelArray($encomenda->id);

        $item = ItemEncomenda::create($itemData);

        // If using default measurements, create the medida
        if (!empty($validated['cliente_medidas_id'])) {
            $item->createMedidaFromDefault();
        }

        return redirect()->route('encomendas.show', $encomenda->id)->with('success', 'Item adicionado à encomenda com sucesso!');
    }

    /**
     * Update an item in the encomenda.
     */
    public function updateItem(Request $request, int $encomendaId, int $itemId)
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

        return redirect()->route('encomendas.show', $encomendaId)->with('success', 'Item atualizado com sucesso!');
    }

    /**
     * Remove an item from the encomenda.
     */
    public function removeItem(Request $request, int $encomendaId, int $itemId)
    {
        $item = ItemEncomenda::where('encomenda_id', $encomendaId)->findOrFail($itemId);
        $item->delete();

        $message = 'Item removido da encomenda com sucesso!';

        if ($request->wantsJson() || $request->header('X-Inertia')) {
            return back()->with('success', $message);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * Get all items of an encomenda.
     */
    public function itens(int $id)
    {
        $encomenda = Encomenda::with(['itens.medida'])->findOrFail($id);

        return redirect()->route('encomendas.show', $id)->with('success', 'Itens da encomenda carregados com sucesso!');
    }
}
