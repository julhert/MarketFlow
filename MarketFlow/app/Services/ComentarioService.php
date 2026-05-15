<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Comentario;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class ComentarioService
{
    // Funcion para obtener los comentarios y el usuario que lo hizo
    public function getComentarios($idProducto) : Collection
    {
        return Comentario::with('user')
            ->where('id_producto', $idProducto)
            ->latest('id_comentario')
            ->get();
    }

    // Funcion para saber si el usuario ya compro el producto, para dejarlo comentar
    public function puedeComentar(int $idProducto) : bool
    {
        if(!Auth::check()) return false;

        return Pedido::where('id_user', Auth::id())
            ->whereHAs('detallePedidos', function ($query) use ($idProducto) {
                $query -> where('id_producto', $idProducto);
            })
            ->exists();
    }

    // Funcion para guardar los comentarios
    public function createComentarios(int $idProducto, string $comentario) : Comentario
    {
        return Comentario::create([
            'id_user' => Auth::id(),
            'id_producto' => $idProducto,
            'comentario' => $comentario
        ]);
    }

    // Funcion para que el comprador elimine el comentario
    public function deleteComentario(int $idComentario): bool
    {
        $comentario = Comentario::find($idComentario);

        if (!$comentario) return false;

        if ($comentario->id_user !== Auth::id()) return false;

        return $comentario->delete();
    }

}
