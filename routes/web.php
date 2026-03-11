<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CarritoController;
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

    Route::resource('productos', App\Http\Controllers\ProductosController::class);
    
    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//añadido --se cambio las views para prueba anombre de las vistas
Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin', function(){
        return view('admin_test');//admin_test cambiar por el nombre de la view
    })->name('admin_test');//admin_test cambiar por el nombre de la view

    Route::get('/usuarios', function(){
        return view('admin.usuarios');
    })->name('usuarios');

    Route::get('/productos', function(){
        return view('admin.productos');
    })->name('productos');

});


Route::middleware(['auth','role:cliente'])->group(function(){
    Route::get('/pagina', function(){
        return view('pagina');
    })->name('pagina');
    Route::Resource('compras', CompraController::class);
    Route::get('/admin', function () {
        return view('admin.inicio');
    })->name('admin.inicio');

    Route::get('/cliente', function () {
        return view('compras.Bienvenida');
    })->name('compras.Bienvenida');

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