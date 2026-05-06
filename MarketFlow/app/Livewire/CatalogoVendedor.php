<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CatalogoVendedor extends Component
{
    use WithPagination;

    public function toggleStatus($productoId)
    {
        $producto = Producto::where('id_user', Auth::id())
                           ->where('id_producto', $productoId)
                           ->first();

        if ($producto) {
            $producto->activo = !$producto->activo;
            $producto->save();
        }
    }

    public function render()
    {
        $productos = Producto::where('id_user', Auth::id())
                            ->latest()
                            ->paginate(5); 

        return view('livewire.catalogo-vendedor', [
            'productos' => $productos
        ]);
    }
}