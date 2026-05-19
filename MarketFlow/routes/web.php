<?php

use App\Livewire\Admin\ConsultarProductos;
use App\Livewire\Admin\ConsultarUsuarios;
use App\Livewire\Admin\ConsultarVentas;
use App\Livewire\Admin\CrearProducto;
use App\Livewire\Admin\CrearUsuarios;
use App\Livewire\Admin\ModificarUsuarios;
use App\Livewire\Admin\Panel;
use App\Livewire\CatalogoVendedor;
use App\Livewire\AgregarProducto;
use App\Livewire\CatalogoGeneral;
use App\Livewire\Vendedor\MisVentas;
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
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->hasRole('vendedor')) {
            return view('dashboard');
        }

        if (Auth::user()->hasRole('comprador')) {
            return redirect()->route('mis-compras');
        }

        abort(403);
    })->name('dashboard');

    Route::middleware('role:vendedor')->group(function () {
        Route::get('/mis-ventas', MisVentas::class)->name('mis-ventas');
    });

    Route::middleware('role:comprador')->group(function () {
        Route::get('/mis-compras', MisCompras::class)->name('mis-compras');
    });

});

// ruta para productos del vendedor
Route::get('/mis-productos', CatalogoVendedor::class)->name('vendedor.productos');

// ruta para agregar nuevo producto
Route::get('/mis-productos/nuevo', AgregarProducto::class)->name('vendedor.productos.create');

// RUTAS PARA LAS DIRECCIONES
Route::get('/direcciones', VerDirecciones::class)->name('direcciones.index');
Route::get('/direcciones/crear', CrearDireccion::class)->name('direcciones.create');
Route::get('/direcciones/{id}/update', ModificarDireccion::class)->name('direcciones.update');
Route::get('/direcciones/mis-direcciones', VerMisDirecciones::class)->name('direcciones.user.index');

// RUTA PARA VER LOS DETALLES DE LOS PRODUCTOS
Route::get('/productos/{id}', VerDetalleProducto::class)->name('producto.detalles');
// RUTAS PARA LOS PEDIDOS
Route::get('/pedidos/crear', CrearPedido::class)->name('pedidos.create');

// RUTAS PARA EL ADMINISTRADOR
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/panel', Panel::class)->name('admin.panel');
    // RUTAS PARA LAS CATEGORIAS
    Route::get('/categorias', VerCategorias::class)->name('categorias');
    Route::get('/categorias/create', CrearCategoria::class)->name('categorias.crear');
    Route::get('/categorias/{id}/update', ModificarCategoria::class)->name('categorias.modificar');
    // RUTAS PARA LOS USUARIOS
    Route::get('/admin/usuarios', ConsultarUsuarios::class)->name('admin.usuarios');
    Route::get('/admin/usuarios/modificar/{id}', ModificarUsuarios::class)->name('usuarios.modificar');
    Route::get('/admin/usuarios/crear', CrearUsuarios::class)->name('usuarios.crear');
    // RUTAS PARA LOS PRODUCTOS
    Route::get('/admin/productos', ConsultarProductos::class)->name('admin.productos');
    Route::get('/admin/productos/create', CrearProducto::class)->name('productos.crear');
    Route::get('/admin/productos/{id}/update', App\Livewire\Admin\ModificarProducto::class)->name('productos.modificar');
    // RUTA PARA VER LOS PEDIDOS
    Route::get('/admin/ventas', ConsultarVentas::class)->name('admin.ventas');
});
