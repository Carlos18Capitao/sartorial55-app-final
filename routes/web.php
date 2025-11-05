<?php

use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\ProfileController;
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
        ]); */
});
Route::resource('clientes', ClienteController::class);

Route::resource('encomendas', EncomendaController::class);

Route::resource('casacos', CasacoController::class);
Route::resource('calcas', CalcaController::class);
Route::resource('camisas', CamisaController::class);
Route::resource('sapatos', SapatoController::class);
Route::resource('fatos', FatoController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
