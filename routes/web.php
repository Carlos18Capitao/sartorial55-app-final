<?php



use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EncomendaController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

// Rotas de clientes
Route::resource('clientes', ClienteController::class);

// Rotas de encomendas
Route::resource('encomendas', EncomendaController::class);


    // Encomenda item routes
    Route::get('/encomendas/{id}/itens', [EncomendaController::class, 'itens'])->name('encomendas.itens');
    Route::post('/encomendas/{id}/itens', [EncomendaController::class, 'addItem'])->name('encomendas.addItem');
    Route::put('/encomendas/{encomendaId}/itens/{itemId}', [EncomendaController::class, 'updateItem'])->name('encomendas.updateItem');
    Route::delete('/encomendas/{encomendaId}/itens/{itemId}', [EncomendaController::class, 'removeItem'])->name('encomendas.removeItem');

require __DIR__ . '/auth.php';
