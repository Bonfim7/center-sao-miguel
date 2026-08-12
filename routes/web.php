<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/theme/app.css', [AssetController::class, 'css'])->name('assets.css');
Route::get('/theme/app.js', [AssetController::class, 'javascript'])->name('assets.javascript');

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'create'])->name('login');
    Route::post('/entrar', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/painel', [EventController::class, 'index'])->name('dashboard');
    Route::get('/calendario/eventos', [EventController::class, 'calendar'])->name('events.calendar');
    Route::get('/eventos/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/eventos', [EventController::class, 'store'])->name('events.store');
    Route::put('/eventos/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/eventos/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::post('/sair', [AuthController::class, 'destroy'])->name('logout');
});
