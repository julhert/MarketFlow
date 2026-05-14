<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Producto;

class PanelAdminService
{
    // Funcion para mostrar todos los usuarios
    public function getAllUsers(?string $filtro = null) : Collection
    {
        $consulta = User::query();

        if($filtro)
        {
            $consulta -> where(function ($query) use ($filtro) {
                $query -> where ('name', 'LIKe', "%{$filtro}%")
                    -> orWhere ('email', 'LIKE', "%{$filtro}%");
            });
        }

        return $consulta -> orderBy('created_at', 'desc') -> get();
    }

    // Función para mostrar todos los productos
    public function getAllProductos(?string $filtro = null) : Collection
    {
        $consulta = Producto::query();

        if($filtro)
        {
            $consulta -> where(function ($query) use ($filtro) {
                $query -> where('nombre', 'LIKE', "%{$filtro}%")
                    -> orWhere('descripcion', 'LIKE', "%{$filtro}%");
            });
        }

        return $consulta -> orderBy('created_at', 'desc') -> get();
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
}
