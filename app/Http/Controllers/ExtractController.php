<?php

namespace App\Http\Controllers;

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

        $fields['financial_planning_id'] = $financialPlanning->id;
        unset($fields['financial_planning_code']);

        $model = new Extract();
        foreach ($fields as $key => $value) {
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

        if($req->type){
            $result->where('type', $req->type);
        }

        return response()->json($result->get());
    }
}
