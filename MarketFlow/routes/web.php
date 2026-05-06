<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Jetstream;

Route::get('/', function () {
    return view('welcome');
});

// Esta ruta (Catálogo) la pongo aquí porque necesitamos que no necesite 
// autenticarse por Jetstream
Route::get('/catalogo', function () {
    return 'Vista del catálogo en construcción';})->name('catalogo');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
