<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mesero/dashboard', [MeseroController::class, 'index'])->name('mesero.dashboard');
Route::get('/cajero/dashboard', [CajeroController::class, 'index'])->name('cajero.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

