<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrcamentoRequest;
use App\Http\Requests\UpdateOrcamentoRequest;
use App\Models\Orcamento;

class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conta = auth()->user()->conta;
        return view('pages.orcamentos', ['orcamentos' => $conta->orcamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrcamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrcamentoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function show(Orcamento $orcamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Orcamento $orcamento)
    {
        return $orcamento->load('categorias');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrcamentoRequest  $request
     * @param  \App\Models\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrcamentoRequest $request, Orcamento $orcamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orcamento  $orcamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orcamento $orcamento)
    {
        //
    }
}
