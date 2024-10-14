<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController; // Asegúrate de incluir tu controlador
use Illuminate\Support\Facades\Route;

// Rutas de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rutas de dashboard
Route::get('/dashboard/mesero', [DashboardController::class, 'mesero'])->name('mesero.dashboard');
Route::get('/dashboard/cajero', [DashboardController::class, 'cajero'])->name('cajero.dashboard');
Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

// Ruta de logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

