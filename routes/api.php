<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BudgetApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ExtractApiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* AUTH */

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::get('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::get('me', [ApiAuthController::class, 'me']);
});

/* USUARIOS */
Route::group(['prefix' => 'users'], function () {
    Route::post('/', [UserController::class, 'store'])->name('users.create');
});

Route::apiResource('budgets', BudgetApiController::class)->middleware('auth:api');

//colocar para receber o budget no parametro igual na de categoria
Route::apiResource('extracts', ExtractApiController::class)->middleware('auth:api');

Route::group([
    'prefix' => 'categories',
], function () {
    Route::get('/{budget}', [CategoryApiController::class, 'index']);
    Route::post('/{budget}', [CategoryApiController::class, 'store']);
    Route::put('/{category}', [CategoryApiController::class, 'update']);
    Route::delete('/{category}', [CategoryApiController::class, 'destroy']);
});