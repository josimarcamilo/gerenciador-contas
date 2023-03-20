<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExtractController;
use App\Http\Controllers\FinancialPlanningController;
use App\Http\Controllers\OrcamentoController;
use Illuminate\Support\Facades\Route;
use JosimarCamilo\LaravelCore\Controllers\UserController;

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

/* USUARIOS */

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/token', [UserController::class, 'generateToken']);


/* ORCAMENTOS */

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orcamentos', [OrcamentoController::class, 'create']);
    Route::get('/orcamentos', [OrcamentoController::class, 'list']);

    Route::post('/plannings', [FinancialPlanningController::class, 'store']);
    Route::post('/budgets', [BudgetController::class, 'store']);
    Route::post('/extracts', [ExtractController::class, 'store']);
});
