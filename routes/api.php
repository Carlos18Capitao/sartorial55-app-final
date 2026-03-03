<?php

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EncomendaController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    // Cliente routes
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::put('/clientes/{id}/medidas', [ClienteController::class, 'updateMedidas']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

    // Encomenda routes
    Route::get('/encomendas', [EncomendaController::class, 'index']);
    Route::post('/encomendas', [EncomendaController::class, 'store']);
    Route::get('/encomendas/{id}', [EncomendaController::class, 'show']);
    Route::put('/encomendas/{id}', [EncomendaController::class, 'update']);
    Route::delete('/encomendas/{id}', [EncomendaController::class, 'destroy']);

    // Encomenda item routes
    Route::get('/encomendas/{id}/itens', [EncomendaController::class, 'itens']);
    Route::post('/encomendas/{id}/itens', [EncomendaController::class, 'addItem']);
    Route::put('/encomendas/{encomendaId}/itens/{itemId}', [EncomendaController::class, 'updateItem']);
    Route::delete('/encomendas/{encomendaId}/itens/{itemId}', [EncomendaController::class, 'removeItem']);
});

