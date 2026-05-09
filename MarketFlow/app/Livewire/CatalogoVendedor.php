<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\ImagenProducto;
use App\Services\ProductoService;
use Illuminate\Support\Facades\Auth;

class CatalogoVendedor extends Component
{
    use WithPagination;

    public $nombre, $descripcion, $precio, $stock, $categoria_id;
    public $imagenes = []; // Para las fotos nuevas

    public function toggleStatus($productoId)
    {
        // $producto = Producto::where('id_user', Auth::id())
        //                    ->where('id_producto', $productoId)
        //                    ->first();

        // Forzamos el usuario 1 y usamos id_producto
        $producto = Producto::where('id_user', 1)
            ->where('id_producto', $productoId)
            ->first();

        if ($producto) {
            $producto->activo = !$producto->activo;
            $producto->save();
        }
    }

    public function render()
    {
        // $productos = Producto::where('id_user', Auth::id())
        //                     ->latest()
        //                     ->paginate(5);

        // Traemos los productos del usuario 1
        $productos = Producto::where('id_user', 1)
            ->latest()
            ->paginate(5);

        return view('livewire.catalogo-vendedor', [
            'productos' => $productos
        ])->layout('layouts.app');
    }
}
