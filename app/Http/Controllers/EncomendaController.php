<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncomendaRequest;
use App\Http\Requests\UpdateEncomendaRequest;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Services\ClienteService;
use Inertia\Inertia;
use Illuminate\Http\Request;



class EncomendaController extends Controller
{
    public function __construct(public ClienteService $cliente){

    }
    /**
     * Display a listing of the resource.
     */
    public function index(request $cliente)
    {
        $clienteFound = $this->cliente->findOne($cliente->id);
        #dd($clienteFound);
        return Inertia::render('encomenda/index',
        [
            'cliente' => $clienteFound
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
    public function store(StoreEncomendaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Encomenda $encomenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encomenda $encomenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEncomendaRequest $request, Encomenda $encomenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encomenda $encomenda)
    {
        //
    }
}
