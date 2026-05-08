<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;

class DireccionService
{
    // Funcion para mostrar las direcciones (solo para administrador)
    public function getDirecciones(?string $filtro = null) : Collection
    {
        $consulta = Direccion::query();

        if ($filtro)
        {
            $consulta -> where(function ($q) use ($filtro) {
                $q -> where('ciudad', 'LIKE', '%' . $filtro . '%')
                    ->orWhere('calle', 'LIKE', '%' . $filtro . '%')
                    ->orWhere('codigo_postal', 'LIKE', '%' . $filtro . '%')
                    ->orWhere('estado', 'LIKE', '%' . $filtro . '%');
            });
        }

        return $consulta -> orderBy('created_at', 'desc') -> get();
    }

    // Funcion para obtener todas las direcciones de un solo usuario (usuario cliente o vendedor)
    public function getMiDireccion() : Collection
    {
        return Direccion::where('id_user', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    // Funcion para crear una direccion
    public function createDireccion(array $datos): Direccion
    {
        $usuario = Auth::user();
        return $usuario->direcciones()->create($datos);
    }

    // Funcion para actualizar direccion
    public function updateDireccion(int $id, array $datos): Direccion
    {
        $direccion = Direccion::findOrFail($id);

        if ($direccion->id_user !== Auth::id()) {
            abort(403, 'Acceso denegado: Esta dirección no te pertenece.');
        }

        $direccion->update([
            'ciudad'          => $datos['ciudad'] ?? $direccion->ciudad,
            'estado'          => $datos['estado'] ?? $direccion->estado,
            'calle'           => $datos['calle'] ?? $direccion->calle,
            'colonia'         => $datos['colonia'] ?? $direccion->colonia,
            'codigo_postal'   => $datos['codigo_postal'] ?? $direccion->codigo_postal,
            'numero_exterior' => $datos['numero_exterior'] ?? $direccion->numero_exterior,
            'numero_interior' => $datos['numero_interior'] ?? $direccion->numero_interior,
            'refencias'       => $datos['refencias'] ?? $direccion->refencias,
        ]);

        return $direccion;
    }

    // Función para eliminar la direccion
    public function deleteDireccion(int $id): bool
    {
        $direccion = Direccion::findOrFail($id);

        if ($direccion->id_user !== Auth::id()) {
            abort(403, 'Acceso denegado: Esta dirección no te pertenece.');
        }

        $direccion->delete();

        return true;
    }
}
