<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresidenteController;
use App\Http\Controllers\Auth\CoordinadorAuthController;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de autenticación para Coordinadores y Auxiliares
Route::prefix('coordinador')->group(function() {
    Route::get('login', [CoordinadorAuthController::class, 'showLoginForm'])->name('coordinador.login');
    Route::post('login', [CoordinadorAuthController::class, 'login']);
    Route::get('register', [CoordinadorAuthController::class, 'showRegisterForm'])->name('coordinador.register');
    Route::post('register', [CoordinadorAuthController::class, 'register']);
    Route::post('logout', [CoordinadorAuthController::class, 'logout'])->name('coordinador.logout');
});

//Crear Presidente
Route::get('/admin/presidente', [PresidenteController::class, 'index'])->name('presidente.index');
Route::get('/presidente/crear', [PresidenteController::class, 'create'])->name('presidente.create');
Route::post('/presidente', [PresidenteController::class, 'store'])->name('presidente.store');


