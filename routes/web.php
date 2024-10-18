<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CajeroController;
use App\Http\Controllers\MeseroController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController; // Asegúrate de incluir tu controlador
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;


Route::get('/', function () {
    return redirect()->route('login.form');
});

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


// -------------REGISTER------------------

//------CAJERO
// Ruta para mostrar el formulario de registro de cajeros
Route::get('/create/cajero', [CajeroController::class, 'showRegistrationForm'])->name('cajeros.create');
// Ruta para almacenar el nuevo cajero
Route::post('/create/cajero', [CajeroController::class, 'register'])->name('cajero.register');
Route::get('/dashboards/cajero/ver_stock', function () {
    return view('dashboards.cajero.ver_stock');
})->name('cajero.ver_stock');

// ------MESERO
Route::get('/create/mesero', [MeseroController::class, 'showRegistrationForm'])->name('meseros.create');
Route::post('/create/mesero', [MeseroController::class, 'register'])->name('mesero.register');
Route::get('/dashboards/mesero/tus_mesas', function () {
    return view('dashboards.mesero.tusMesas');
})->name('mesero.tusMesas');
Route::get('/dashboards/mesero/ver_inventario', function () {
    return view('dashboards.mesero.verInventario');
})->name('mesero.verInventario');

// Cambia esta línea
Route::get('/dashboards/mesero/tomarPedido', [ProductoController::class, 'tomarPedido'])->middleware(['auth']);


//------ADMIN
Route::get('/create/admin', [AdminController::class, 'showRegistrationForm'])->name('admins.create');
Route::post('/create/admin', [AdminController::class, 'register'])->name('admin.register');

//----------------------------------middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');