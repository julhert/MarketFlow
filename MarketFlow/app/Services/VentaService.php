<?php

namespace App\Services;

use App\Models\Pedido;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VentaService
{
    /**
     * Obtener las ventas que corresponden única y exclusivamente al vendedor actual.
     */
    public function obtenerVentasPorVendedor($vendedorId, $search = '', $perPage = 10): LengthAwarePaginator
    {
        return Pedido::whereHas('detallePedidos.producto', function ($query) use ($vendedorId) {
            // Filtramos pedidos que contengan al menos un producto subido por este vendedor
            $query->where('id_user', $vendedorId); 
        })
        ->with(['user', 'detallePedidos' => function ($query) use ($vendedorId) {
            // Eager Loading: Traemos únicamente los artículos vendidos por este usuario
            $query->whereHas('producto', function ($q) use ($vendedorId) {
                $q->where('id_user', $vendedorId);
            })->with('producto');
        }])
        ->when($search, function($query) use ($search) {
            // Buscador reactivo por folio o nombre del comprador
            $query->where(function($q) use ($search) {
                $q->where('folio', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($qUser) use ($search) {
                      $qUser->where('name', 'LIKE', "%{$search}%");
                  });
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
    }
}