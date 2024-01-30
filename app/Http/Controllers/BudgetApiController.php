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
            ->orderBy('month')
            ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBudgetRequest  $request
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
     * @param  Budget  $budget
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
     * @param  UpdateBudgetRequest  $request
     * @param  Budget  $budget
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
     * @param  Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
