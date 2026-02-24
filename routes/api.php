<?php

use App\Http\Controllers\Api\ClienteController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::put('/clientes/{id}/medidas', [ClienteController::class, 'updateMedidas']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
});

