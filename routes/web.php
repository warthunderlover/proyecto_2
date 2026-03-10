<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Redirigir al login al entrar a /
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('register');
Route::post('/registro', [AuthController::class, 'registro']);
// funcion de inactivar
Route::post('/users/{id}/inactivate', [App\Http\Controllers\UserController::class, 'inactivate'])->name('users.inactivate');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Página de bienvenida
    Route::get('/pagina', function () {
        return view('pagina');
    })->name('pagina');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rutas de administración de usuarios
    Route::resource('users', UserController::class);
}); 