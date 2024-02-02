<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('app', [SpaController::class, 'index'])->name('app');
Route::get('app/{any}', [SpaController::class, 'index'])->where('any', '.*')->name('spa');

Route::get('version', function () {
    return response()->json(['version' => '1.2']);
});
