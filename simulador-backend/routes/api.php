<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Presentation\Http\Controllers\SimularController;
use App\Presentation\Http\Controllers\AnaliseRiscoController;
use App\Presentation\Http\Controllers\MargemCooperadoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'simular'], function() {
    Route::post('/emprestimo', [SimularController::class, 'simular']);
});

Route::group(['prefix' => 'ente'], function() {
    Route::post('/atualizar/margem', [MargemCooperadoController::class, 'atualizar']);
});
