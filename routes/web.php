<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('register');
Route::post('/registro', [AuthController::class, 'registro']);

Route::middleware('auth')->group(function () {

    // Páginas principales
    Route::get('/pagina', function () {
        return view('pagina');
    })->name('pagina');

    Route::get('/admin', function () {
        return view('admin.inicio');
    })->name('admin.inicio');

    // CRUD inventario
    Route::resource('inventario', ProductoController::class)->except(['show']);

    // Stock
    Route::get('/inventario/{id}/stock', [ProductoController::class, 'stock']);
    Route::post('/inventario/{id}/stock', [ProductoController::class, 'agregarStock']);

    // Productos inactivos / reactivar
    Route::get('/inventario/inactivos', [ProductoController::class, 'inactivos']);
    Route::put('/inventario/{id}/activar', [ProductoController::class, 'activar']);
    Route::put('/inventario/{id}/desactivar', [ProductoController::class, 'desactivar']);

    // Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});