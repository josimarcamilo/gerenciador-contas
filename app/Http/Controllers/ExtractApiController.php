<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtractRequest;
use App\Http\Requests\UpdateExtractRequest;
use App\Models\Budget;
use App\Models\Extract;
use App\Util\StatusExtract;
use App\Util\TypeExtract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExtractApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Budget $budget)
    {
        Gate::authorize('view', $budget);

        return $budget->extracts()
            ->orderBy('type')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtractRequest $request, Budget $budget)
    {
        Gate::authorize('view', $budget);

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
        Gate::authorize('view', $extract);

        return $extract;
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExtractRequest $request, Extract $extract)
    {
        Gate::authorize('update', $extract);

        $extract->description = $request->description;
        $extract->value = $request->value;

        if ($request->status) {
            $extract->status = StatusExtract::toInteger($request->status);
        }

        if ($request->category) {
            $category = $extract->budget->categories()->where('id', $request->category)
                ->first();
            throw_if(! $category, new Exception('Category not found.', 404));
            $extract->category_id = $category->id;
        }
        $extract->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extract $extract)
    {
        Gate::authorize('delete', $extract);

        $extract->delete();
    }
}
