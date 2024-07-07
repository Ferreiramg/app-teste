<?php

use App\Http\Controllers\Cliente\ClientesController;
use App\Http\Controllers\Cliente\EnderecoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $cidades = \App\Models\Cidades::get()->sortBy('uf')->sortBy('nome')->values();
    return view('app', compact('cidades'));
});

Route::prefix('clientes')->group(function () {

    // Route::get('/', [ClientesController::class, 'index']);

    Route::post('/', [ClientesController::class, 'store']);

    Route::get('/', [ClientesController::class, 'fetch']);

    Route::delete('/{id}', [ClientesController::class, 'destroy']);

    Route::post('/endereco', [EnderecoController::class, 'store']);
});
