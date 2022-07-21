<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth'])->group(function () {
    // Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/contas', [HomeController::class, 'criarOrEditarConta'])->name('contas.criarEditar');
    Route::post('/contas/quitar', [HomeController::class, 'quitarConta'])->name('contas.quitar');
    Route::post('/contas/deletar', [HomeController::class, 'deletarConta'])->name('contas.deletar');
    Route::post('/contas/editar', [HomeController::class, 'editarConta'])->name('contas.editar');
});


Route::get('/clientes/{id}', [ClientesController::class, 'contas'])->name('cliente');

// Route::view('/', 'welcome');

Route::get('/', function(){
    return "<h1>v1</h1><h1>". gethostname() ."</h1>";
});
