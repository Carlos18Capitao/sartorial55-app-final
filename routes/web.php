<?php



use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\AgendamentoController;

// Rotas de clientes
Route::resource('clientes', ClienteController::class);

// Rotas de encomendas
Route::resource('encomendas', EncomendaController::class);

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('home');


    // Encomenda item routes
    Route::get('/encomendas/{id}/itens', [EncomendaController::class, 'itens'])->name('encomendas.itens');
    Route::post('/encomendas/{id}/itens', [EncomendaController::class, 'addItem'])->name('encomendas.addItem');
    Route::put('/encomendas/{encomendaId}/itens/{itemId}', [EncomendaController::class, 'updateItem'])->name('encomendas.updateItem');
    Route::delete('/encomendas/{encomendaId}/itens/{itemId}', [EncomendaController::class, 'removeItem'])->name('encomendas.removeItem');

// Agendamentos
Route::post('/agendamentos', [AgendamentoController::class, 'store']);

require __DIR__ . '/auth.php';
