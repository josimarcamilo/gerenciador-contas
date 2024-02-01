<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtractRequest;
use App\Models\Extract;
use App\Util\StatusExtract;
use App\Util\TypeExtract;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ExtractApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payload = auth()->payload();

        return Extract::where('account_id', $payload['account'])
            ->orderBy('type')
            ->simplePaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtractRequest $request)
    {
        $budgetDate = new Carbon($request->budget);
        $user = $request->user();

        $budget = $user->account->budgets()
            ->whereDate('month', $budgetDate->format('Y-m-d'))
            ->first();
        throw_if(! $budget, new Exception('Budget not found.', 404));

        $extract = new Extract();
        $extract->account_id = $budget->account_id;
        $extract->budget_id = $budget->id;
        $extract->description = $request->description;
        $extract->value = $request->value;
        $extract->type = TypeExtract::toInteger($request->type);
        
        if ($request->status) {
            $extract->status = StatusExtract::toInteger($request->status);
        }
        if ($request->category) {
            $category = $budget->categories()->where('id', $request->category)
                ->first();
            throw_if(! $category, new Exception('Category not found.', 404));
            $extract->category_id = $category->id;
        }
        $extract->save();

        return $extract;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Extract $extract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extract $extract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extract $extract)
    {
        //
    }
}
