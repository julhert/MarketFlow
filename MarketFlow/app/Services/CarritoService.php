<?php

namespace App\Services;
use App\Models\Producto;
use App\Models\Carrito;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class CarritoService
{
    public function addItem(int $idProducto, int $cantidad = 1) : void
    {
        $producto = Producto::findOrFail($idProducto);

        $itemExistente = Carrito::where('id_user', Auth::id())
                                    ->where('id_producto', $idProducto)
                                    ->first();

        $cantidadActual = $itemExistente ? $itemExistente->cantidad : 0;
        $cantidadNueva = $cantidadActual + $cantidad;

        if($cantidadNueva > $producto->stock)
        {
            throw new Exception("Stock insuficiente, disponible: {$producto->stock}");
        }

        Carrito::updateOrCreate(
            ['id_user' => Auth::id(), 'id_producto' => $idProducto],
            ['cantidad' => $cantidadNueva]
        );
    }

    public function updateCantidad(int $idItem, int $cantidad) : void
    {
        if($cantidad < 1)
        {
            throw new Exception("La cantidad minima es 1");
        }

        $item = Carrito::where('id_carrito', $idItem)
                            ->where('id_user', Auth::id())
                            ->firstOrFail();

        $producto = Producto::findOrFail($item->id_producto);

        if($cantidad > $producto->stock)
        {
            throw new Exception("Stock insuficiente, disponible: {$producto->stock}");
        }

        $item->update(['cantidad' => $cantidad]);
    }

    public function getCarrito() : Collection
    {
        return Carrito::with('producto')
                            ->where('id_user', Auth::id())
                            ->get();
    }

    public function calcularTotal(Collection $items): float
    {
        return $items->sum(fn($item) => $item->producto->precio * $item->cantidad);
    }

    public function eliminarItem(int $idItem): void
    {
        Carrito::where('id_carrito', $idItem)
            ->where('id_user', Auth::id())
            ->delete();
    }

    public function vaciarCarrito(): void
    {
        Carrito::where('id_user', Auth::id())->delete();
    }
}
