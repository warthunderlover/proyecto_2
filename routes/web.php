<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductosController;
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

Route::middleware('auth')->group(function () {

    Route::get('/pagina', function () {
        return view('pagina');
    })->name('pagina');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('users', UserController::class);
    Route::resource('productos', ProductoController::class)->except(['show']);

    //  Carrito aquí, accesible para TODOS los roles
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');

    //  Producto visible para todos
    Route::get('/producto', [ProductosController::class, 'index'])->name('producto');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin', function () { return view('admin.inicio'); })->name('admin.inicio');
    Route::get('/usuarios', function(){ return view('admin.usuarios'); })->name('usuarios');
    Route::resource('inventario', ProductoController::class)->except(['show']);
    Route::get('/inventario/{id}/stock', [ProductoController::class, 'stock']);
    Route::post('/inventario/{id}/stock', [ProductoController::class, 'agregarStock']);
    Route::get('/inventario/inactivos', [ProductoController::class, 'inactivos']);
    Route::put('/inventario/{id}/activar', [ProductoController::class, 'activar']);
    Route::put('/inventario/{id}/desactivar', [ProductoController::class, 'desactivar']);
    Route::resource('productos', ProductosController::class);
});

Route::middleware(['auth','role:cliente'])->group(function(){
    Route::get('/cliente', function () { return view('compras.Bienvenida'); })->name('compras.Bienvenida');
    Route::resource('compras', CompraController::class);
});