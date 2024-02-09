<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Extract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Budget $budget)
    {
        Gate::authorize('view', $budget);

        return $budget->categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request, Budget $budget)
    {
        Gate::authorize('view', $budget);

        $model = new Category();
        $model->account_id = $budget->account_id;
        $model->budget_id = $budget->id;
        $model->description = $request->description;
        $model->planned = $request->planned;
        $model->save();

        return $model;
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('update', $category);

        $category->description = $request->description;
        $category->planned = $request->planned;
        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        $category->delete();

        return [];
    }
}
