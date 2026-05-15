<?php

namespace App\Services;
use App\Models\Producto;

class DetalleProductoService
{
    public function getProductoForId(int $id) : Producto
    {
        return Producto::with('imagenes')->findOrFail($id);
    }
}
