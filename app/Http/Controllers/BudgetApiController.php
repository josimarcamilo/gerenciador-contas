<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Illuminate\Support\Facades\Gate;

class BudgetApiController extends Controller
{
    /**
     * Lista todos os orçamentos do usuário.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payload = auth()->payload();

        return Budget::where('account_id', $payload['account'])
            ->orderBy('month', 'desc')
            ->simplePaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBudgetRequest $request)
    {
        $payload = auth()->payload();

        $model = new Budget();
        $model->month = $request->month;
        $model->account_id = $payload['account'];
        $model->save();

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        Gate::authorize('view', $budget);

        return $budget;
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        Gate::authorize('update', $budget);

        $budget->month = $request->month;
        $budget->save();

        return $budget;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
