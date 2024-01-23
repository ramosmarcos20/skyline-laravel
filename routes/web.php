<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Redirigir directamente a la página de inicio de sesión al cargar la aplicación
Route::redirect('/', '/login');

Route::middleware(['guest'])->group(function () {
    // Muestra la vista de login solo si el usuario no está autenticado
    Route::get('/login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');

    // También puedes agregar una ruta para el registro si lo deseas
    Route::get('/register', function () {
        return Inertia::render('Auth/Register');
    })->name('register');
});

// Rutas protegidas para usuarios autenticados
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


