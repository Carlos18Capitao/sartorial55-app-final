<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSapatoRequest;
use App\Http\Requests\UpdateSapatoRequest;
use App\Models\Sapato;

class SapatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSapatoRequest $request)
    {
        $sapato = Sapato::create($request->validated());
        return redirect()->back()->with('success', 'Sapato criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sapato $sapato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sapato $sapato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSapatoRequest $request, Sapato $sapato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sapato $sapato)
    {
        //
    }
}
