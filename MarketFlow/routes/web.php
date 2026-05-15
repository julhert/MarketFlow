<?php

use App\Livewire\CatalogoVendedor;
use App\Livewire\AgregarProducto;
use App\Livewire\CatalogoGeneral;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Livewire\ModificarCategoria;
use App\Livewire\CrearCategoria;
use App\Livewire\VerCategorias;
use App\Livewire\CrearDireccion;
use App\Livewire\ModificarDireccion;
use App\Livewire\VerDetalleProducto;
use App\Livewire\VerDirecciones;
use App\Livewire\VerMisDirecciones;
use App\Livewire\CrearPedido;
use App\Livewire\MisCompras;
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
    'role:vendedor'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:comprador' // Esto asegura que solo los compradores entren
])->group(function () {

    // Rutas para mostrar el historial de pedidos del comprador
    Route::get('/mis-compras', MisCompras::class)->name('mis-compras');
});

// ruta para productos del vendedor
Route::get('/mis-productos', CatalogoVendedor::class)->name('vendedor.productos');

// ruta para agregar nuevo producto
Route::get('/mis-productos/nuevo', AgregarProducto::class)->name('vendedor.productos.create');

// Ruta para productos
// Route::resource('productos', ProductoController::class);

// // Para borrar una imagen específica
// Route::delete('/imagen-producto/{imagen}', [ProductoController::class, 'destroyImagen'])->name('productos.imagen.destroy');

// // Para añadir nuevas imágenes desde el modal
// Route::post('/producto/{producto}/add-imagenes', [ProductoController::class, 'addImagenes'])->name('productos.imagen.add');

// RUTAS PARA LAS CATEGORIAS
Route::get('/categorias', VerCategorias::class)->name('categorias');
Route::get('/categorias/create', CrearCategoria::class)->name('categorias.crear');
Route::get('/categorias/{id}/update', ModificarCategoria::class)->name('categorias.modificar');

// RUTAS PARA LAS DIRECCIONES
Route::get('/direcciones', VerDirecciones::class)->name('direcciones.index');
Route::get('/direcciones/crear', CrearDireccion::class)->name('direcciones.create');
Route::get('/direcciones/{id}/update', ModificarDireccion::class)->name('direcciones.update');
Route::get('/direcciones/mis-direcciones', VerMisDirecciones::class)->name('direcciones.user.index');

// RUTA PARA VER LOS DETALLES DE LOS PRODUCTOS
Route::get('/productos/{id}', VerDetalleProducto::class)->name('producto.detalles');
// RUTAS PARA LOS PEDIDOS
Route::get('/pedidos/crear', CrearPedido::class)->name('pedidos.create');
