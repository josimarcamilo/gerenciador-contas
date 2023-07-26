<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExtractController;
use App\Http\Controllers\FinancialAreaController;
use App\Http\Controllers\FinancialPlanningController;
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
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::post('me', [ApiAuthController::class, 'me']);
});

/* USUARIOS */

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/tokens', [UserController::class, 'storeToken']);

/* ORCAMENTOS */

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/areas', [FinancialAreaController::class, 'all']);

    Route::post('/plannings', [FinancialPlanningController::class, 'store']);
    Route::get('/plannings/{area}', [FinancialPlanningController::class, 'index']);
    Route::put('/plannings/{id}', [FinancialPlanningController::class, 'update']);

    Route::post('/budgets', [BudgetController::class, 'store']);
    Route::get('/budgets/{planning}', [BudgetController::class, 'all']);
    Route::put('/budgets/{id}', [BudgetController::class, 'update']);

    Route::post('/extracts', [ExtractController::class, 'store']);
    Route::get('/extracts/{planning}', [ExtractController::class, 'all']);
    Route::put('/extracts/{id}', [ExtractController::class, 'update']);
});
