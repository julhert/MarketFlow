<?php

use App\Livewire\CatalogoGeneral;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Jetstream;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', CatalogoGeneral::class)->name('catalogo');

// Esta ruta (Catálogo) la pongo aquí porque necesitamos que no necesite 
// autenticarse por Jetstream
// Route::get('/catalogo', function () {
//     return 'Vista del catálogo en construcción';})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
