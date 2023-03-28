<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\FinancialPlanning;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    public function store(Request $req)
    {
        $fields = $req->validate([
            "financial_planning_code" => 'required',
            "categories" => 'required|array'
        ]);

        $financialPlanning = FinancialPlanning::where('uuid', $fields['financial_planning_code'])->first();

        if (! $financialPlanning) {
            throw new Exception('error');
        }

        try {
            DB::beginTransaction();

            $modelsCreateds = [];

            foreach ($fields['categories'] as $category) {
                $model = new Budget();
                $model->financial_planning_id = $financialPlanning->id;
                $model->description = $category['description'];
                $model->percentage = $category['percentage'];
                $model->save();

                $modelsCreateds[] = $model;
            }
            DB::commit();

            return response()->json($modelsCreateds, 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function all(Request $req, $planning)
    {
        $financialPlanning = FinancialPlanning::where('uuid', $planning)->first();

        if (! $financialPlanning) {
            throw new Exception('error');
        }

        return Budget::where('financial_planning_id', $financialPlanning->id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Budget::find($id);

        if (! $model) {
            throw new Exception('Entity not found');
        }

        foreach ($request->all() as $key => $value) {
            $model->$key = $value;
        }

        $model->save();
    }
}
