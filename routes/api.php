<?php

use App\Http\Controllers\ApiAuthController;
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

});
