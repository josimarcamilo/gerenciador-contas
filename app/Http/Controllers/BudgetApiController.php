<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Throwable;

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
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBudgetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBudgetRequest $request)
    {
        try{
            $payload = auth()->payload();
    
            $model = new Budget();
            $model->month = $request->month;
            $model->account_id = $payload['account'];
            $model->save();
            return $model;
        }catch(Throwable $th){
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        return $budget;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBudgetRequest  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $budget->month = $request->month;
        $budget->save();
        return $budget;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
