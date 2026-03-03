<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

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
    public function index()
    {
        $clientes = $this->clienteService->getAll();

        return Inertia::render('Clientes/Index', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Clientes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request): RedirectResponse
    {
        $this->clienteService->create($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $cliente = $this->clienteService->getById($cliente->id);

        return Inertia::render('Clientes/Show', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $cliente = $this->clienteService->getById($cliente->id);

        return Inertia::render('Clientes/Edit', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $this->clienteService->update($cliente->id, $request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        $this->clienteService->delete($cliente->id);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente excluído com sucesso.');
    }
}
