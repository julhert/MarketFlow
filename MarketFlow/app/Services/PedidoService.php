<?php

namespace App\Services;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PedidoService
{
    public function crearPedidoCompleto(array $datos, $itemsCarrito)
    {
        return DB::transaction(function () use ($datos, $itemsCarrito) {
            // 1. Crear el Pedido Padre
            $pedido = Pedido::create([
                'id_user'      => auth()->id(),
                'id_direccion' => $datos['id_direccion'],
                'folio'        => $this->generarFolioUnico(),
                'metodoPago'   => $datos['metodoPago'],
                'totalCompra'  => $datos['totalCompra'],
            ]);

            // 2. Registrar cada producto en DetallePedido y bajar Stock
            foreach ($itemsCarrito as $item) {
                DetallePedido::create([
                    'id_pedido'       => $pedido->id_pedido,
                    'id_producto'     => $item->id_producto,
                    'precio_unitario' => $item->producto->precio,
                    'cantidad'        => $item->cantidad,
                ]);

                // Cumplimos el criterio de Jira: Reducción de Inventario
                $item->producto->decrement('stock', $item->cantidad);
            }

            // 3. Limpiar el carrito del usuario
            Carrito::where('id_users', auth()->id())->delete();

            return $pedido;
        });
    }

    private function generarFolioUnico()
    {
        do {
            // Genera algo como MF-832941
            $folio = 'MF-' . random_int(100000, 999999);
        } while (Pedido::where('folio', $folio)->exists());

        return $folio;
    }
}
