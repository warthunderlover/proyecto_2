<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// Redirigir al login al entrar a /
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('register');
Route::post('/registro', [AuthController::class, 'registro']);

// Función de inactivar usuario
Route::post('/users/{id}/inactivate', [UserController::class, 'inactivate'])->name('users.inactivate');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Página principal
    Route::get('/pagina', function () {
        return view('pagina');
    })->name('pagina');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rutas de administración de usuarios
    Route::resource('users', UserController::class);

    // CRUD de productos/inventario
    Route::resource('productos', ProductoController::class)->except(['show']);

    // Stock
    Route::get('/inventario/{id}/stock', [ProductoController::class, 'stock']);
    Route::post('/inventario/{id}/stock', [ProductoController::class, 'agregarStock']);

    // Productos inactivos / reactivar
    Route::get('/inventario/inactivos', [ProductoController::class, 'inactivos']);
    Route::put('/inventario/{id}/activar', [ProductoController::class, 'activar']);
    Route::put('/inventario/{id}/desactivar', [ProductoController::class, 'desactivar']);

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');

    // Compras
    Route::resource('compras', CompraController::class);

    // Admin inicio
    Route::get('/admin', function () {
        return view('admin.inicio');
    })->name('admin.inicio');

});