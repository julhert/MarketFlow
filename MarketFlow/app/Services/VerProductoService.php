<?php

namespace App\Services;
use App\Models\Producto;

class VerProductoService
{
    // Vamos a ver si funciona, es una funcion
    // que recibe como parametro el id para buscar en la tabla
    // productos y que los muestre con todo y las imagenes
    public function getDetalleProducto(int $id) : Producto
    {
        return Producto::with('imagenes')
            ->where('id_producto', $id)
            ->firstOrFail();
    }
}
