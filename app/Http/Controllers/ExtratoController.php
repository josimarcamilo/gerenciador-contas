<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtratoRequest;
use App\Http\Requests\UpdateExtratoRequest;
use App\Models\Extrato;

class ExtratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreExtratoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtratoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Extrato  $extrato
     * @return \Illuminate\Http\Response
     */
    public function show(Extrato $extrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Extrato  $extrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Extrato $extrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExtratoRequest  $request
     * @param  \App\Models\Extrato  $extrato
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExtratoRequest $request, Extrato $extrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Extrato  $extrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extrato $extrato)
    {
        //
    }
}
