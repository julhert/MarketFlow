<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator; // <--- Importamos el paginador
use App\Models\User;
use App\Models\Producto;
use App\Models\Pedido;

class PanelAdminService
{
    // Funcion para mostrar todos los usuarios con paginación
    public function getAllUsers(?string $filtro = null) : LengthAwarePaginator // <--- Cambiamos Collection por Paginator
    {
        $consulta = User::query();

        if($filtro)
        {
            $consulta -> where(function ($query) use ($filtro) {
                $query -> where ('name', 'LIKE', "%{$filtro}%")
                    -> orWhere ('email', 'LIKE', "%{$filtro}%");
            });
        }

        // Cambiamos get() por paginate()
        return $consulta -> orderBy('created_at', 'desc') -> paginate(10); 
    }

    // Función para mostrar todos los productos con paginación
    public function getAllProductos(?string $filtro = null) : LengthAwarePaginator // <--- Cambiamos Collection por Paginator
    {
        $consulta = Producto::query();

        if($filtro)
        {
            $consulta -> where(function ($query) use ($filtro) {
                $query -> where('nombre', 'LIKE', "%{$filtro}%")
                    -> orWhere('descripcion', 'LIKE', "%{$filtro}%");
            });
        }

        // Cambiamos get() por paginate()
        return $consulta -> orderBy('created_at', 'desc') -> paginate(10); 
    }

    // Funcion para mostrar el numero total de usuarios registrados
    public function getCountUsers() : int
    {
        return User::count();
    }

    // Funcion para mostrar el numero total de productos registrados
    public function getCountProductos() : int
    {
        return Producto::count();
    }

    // Funcion para mostrar el total de vendedores
    public function getCountVendedores() : int
    {
        return User::role('vendedor')->count();
    }

    // Funcion para mostrar los usuarios que son vendores (te lo dejo opcional we)
    public function getVendedores() : Collection
    {
        return User::role('vendedor')->get();
    }

    // Funcion para ver el numero de clientes
    public function getCountClientes() : int
    {
        return User::role('comprador')->count();
    }

    // Funcion para ver el numero de pedidos
    public function getCountPedidos() : int
    {
        return Pedido::count();
    }
}