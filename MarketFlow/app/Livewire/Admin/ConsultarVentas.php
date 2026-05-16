<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedido;

class ConsultarVentas extends Component
{
    use WithPagination;

    public $search = '';
    
    // Variables para el Modal de Detalles
    public $pedidoSeleccionado; 
    public $mostrarModal = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Método adaptado de tu clase MisCompras
    public function verDetalle($id_pedido)
    {
        // Cargamos el pedido con el usuario y los detalles de los productos
        $this->pedidoSeleccionado = Pedido::with(['user', 'detallePedidos.producto'])
            ->findOrFail($id_pedido);

        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
        $this->reset('pedidoSeleccionado');
    }

    public function render()
    {
        // Agregamos 'detallePedidos' al with() para calcular los totales reales
        $datos = Pedido::with(['user', 'detallePedidos'])
            ->where('id_pedido', 'LIKE', "%{$this->search}%")
            ->orWhereHas('user', function ($query) {
                $query->where('name', 'LIKE', "%{$this->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.consultar-ventas', [
            'datos' => $datos
        ])->layout('layouts.app');
    }
}