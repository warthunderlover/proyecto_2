<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('register');
Route::post('/registro', [AuthController::class, 'registro']);


Route::middleware('auth')->group(function () {
    Route::get('/pagina', function () {
        return view('pagina');
    })->name('pagina');
    
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
});