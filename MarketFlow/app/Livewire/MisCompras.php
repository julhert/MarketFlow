<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Services\PedidoService;
use Livewire\WithPagination;

class MisCompras extends Component
{
    use WithPagination;

    public $pedidoSeleccionado; // Aquí guardaremos el pedido con sus productos
    public $mostrarModal = false;
    protected $paginationTheme = 'tailwind'; //para mantener el estilo de paginación de Tailwind

    public function render(PedidoService $pedidoService)
    {
        return view('livewire.mis-compras', [
            // Llamamos al service para traer la data
            'pedidos' => $pedidoService->obtenerHistorialUsuario(8),
        ])->layout('layouts.app');
    }

    // Función para cargar el detalle del pedido seleccionado y mostrarlo en un modal
    public function verDetalle($id_pedido)
    {
        // Cargamos el pedido con sus detalles y productos (Eager Loading)
        $this->pedidoSeleccionado = Pedido::with('detallePedidos.producto.imagenes')
            ->where('id_user', auth()->id())
            ->findOrFail($id_pedido);

        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
        $this->reset('pedidoSeleccionado');
    }
}
