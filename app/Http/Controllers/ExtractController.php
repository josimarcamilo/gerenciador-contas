<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Extract;
use App\Models\FinancialPlanning;
use Exception;
use Illuminate\Http\Request;

class ExtractController extends Controller
{
    public function store(Request $req)
    {
        $fields = $req->validate([
            'financial_planning_code' => 'required',
            'type' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'category' => 'nullable',
            'due_date' => 'nullable',
            'status' => 'nullable'
        ]);

        $financialPlanning = FinancialPlanning::where('uuid', $fields['financial_planning_code'])->first();

        if (! $financialPlanning) {
            throw new Exception('Financial Planning not found');
        }

        if ($req->category) {
            $category = Budget::where('id', $req->category)
                ->where('financial_planning_id', $financialPlanning->id)->first();

            if (! $category) {
                throw new Exception('Entity Budget not found');
            }
        }

        $fields['financial_planning_id'] = $financialPlanning->id;

        $model = new Extract();
        foreach ($fields as $key => $value) {
            if ($key == 'financial_planning_code') {
                continue;
            }
            $model->$key = $value;
        }

        $model->save();

        return response()->json($model, 201);
    }

    public function all(Request $req, $planning)
    {
        $financialPlanning = FinancialPlanning::where('uuid', $planning)->first();

        if (! $financialPlanning) {
            throw new Exception('Financial Planning not found');
        }

        $result = Extract::where('financial_planning_id', $financialPlanning->id);

        if ($req->type) {
            $result->where('type', $req->type);
        }

        return response()->json($result->get());
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
        $model = Extract::find($id);

        if (! $model) {
            throw new Exception('Entity not found');
        }

        $financialPlanning = FinancialPlanning::where('uuid', $request->financial_planning_code)->first();

        if (! $financialPlanning) {
            throw new Exception('Entity not found');
        }

        if ($request->category) {
            $category = Budget::where('id', $request->category)
                ->where('financial_planning_id', $financialPlanning->id)->first();

            if (! $category) {
                throw new Exception('Entity Budget not found');
            }
        }

        foreach ($request->all() as $key => $value) {
            if ($key == 'financial_planning_code') {
                continue;
            }
            $model->$key = $value;
        }

        $model->save();
    }
}
