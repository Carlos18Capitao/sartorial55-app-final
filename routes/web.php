<?php



use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CasacoController;
use App\Http\Controllers\CalcaController;
use App\Http\Controllers\CamisaController;
use App\Http\Controllers\SapatoController;
use App\Http\Controllers\FatoController;

Route::get('/', function () {
    /* return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

// Rotas de clientes
Route::resource('clientes', \App\Http\Controllers\ClienteController::class);

        ]); */
});
Route::resource('clientes', ClienteController::class);


require __DIR__ . '/auth.php';
