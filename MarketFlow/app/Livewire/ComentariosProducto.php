<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ComentarioService;
use Illuminate\Support\Facades\Auth;

class ComentariosProducto extends Component
{

public $id_producto;
    public $nuevoComentario = '';

    public function mount($idProducto)
    {
        $this->id_producto = $idProducto;
    }

    // Propiedad computada para verificar permisos en tiempo real
    public function getPuedeComentarProperty(ComentarioService $service)
    {
        return $service->puedeComentar($this->id_producto);
    }

    public function enviarComentario(ComentarioService $service)
    {
        $this->validate([
            'nuevoComentario' => 'required|min:5|max:500',
        ]);

        if (!$this->puede_comentar) {
            session()->flash('error', 'Debes comprar el producto para comentar.');
            return;
        }

        $service->createComentarios($this->id_producto, $this->nuevoComentario);

        $this->reset('nuevoComentario');
        session()->flash('mensaje', '¡Comentario publicado con éxito!');
    }

    public function borrarComentario(int $idComentario, ComentarioService $service)
    {
        $resultado = $service->deleteComentario($idComentario);

        if ($resultado) {
            session()->flash('mensaje', 'Comentario eliminado correctamente.');
        } else {
            session()->flash('error', 'No tienes permiso para realizar esta acción.');
        }
    }

    public function render(ComentarioService $service)
    {
        return view('livewire.comentarios-producto', [
            'comentarios' => $service->getComentarios($this->id_producto)
        ]   )->layout('layouts.app');
    }
}
