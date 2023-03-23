<?php

namespace App\Http\Controllers;

use App\Http\Resources\FinancialPlanningResource;
use App\Models\FinancialArea;
use App\Models\FinancialPlanning;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class FinancialPlanningController extends Controller
{
    public function store(Request $req)
    {
        $fields = $req->validate([
            "financial_area_code" => 'required',
            "reference_month" => 'required'
        ]);

        $financialArea = FinancialArea::where('uuid', $fields['financial_area_code'])->first();

        if (! $financialArea) {
            throw new Exception('error');
        }

        if (FinancialPlanning::where('financial_area_id', $financialArea->id)
            ->where('status', FinancialPlanning::OPEN)
            ->exists()) {
            throw new Exception('existis fiancial planning open status');
        }

        $model = new FinancialPlanning();
        $model->uuid = Uuid::uuid4();
        $model->financial_area_id = $financialArea->id;
        $model->status = FinancialPlanning::OPEN;
        $model->reference_month = $fields['reference_month'];
        $model->save();

        return response()->json([
            'id' => $model->uuid,
            'status' => $model->status,
            'reference_month' => $model->reference_month,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ], 201);
    }

    public function all(Request $req, $area)
    {
        $financialArea = FinancialArea::where('uuid', $area)->first();

        if (! $financialArea) {
            throw new Exception('error');
        }

        $finacialPlannins = FinancialPlanning::where('financial_area_id', $financialArea->id)->get();

        return FinancialPlanningResource::collection($finacialPlannins);
    }
}
