<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCamisaRequest;
use App\Http\Requests\UpdateCamisaRequest;
use App\Models\Camisa;

class CamisaController extends Controller
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
    public function store(StoreCamisaRequest $request)
    {
        $camisa = Camisa::create($request->validated());
        return redirect()->back()->with('success', 'Camisa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Camisa $camisa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Camisa $camisa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCamisaRequest $request, Camisa $camisa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Camisa $camisa)
    {
        //
    }
}
