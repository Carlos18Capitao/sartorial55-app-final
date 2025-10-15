<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;
use App\Models\Cliente;
use Inertia\Inertia;

class ClienteController extends Controller
{
    public function __construct(private ClienteService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = $this->service->getAll();
        return Inertia::render('cliente/index',
            [
                'clientes' => $clientes
            ]
        );
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
    public function store(StoreClienteRequest $request)
    {
        $this->service->new($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $this->service->delete($cliente->id);
        return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso!');
    }
}
