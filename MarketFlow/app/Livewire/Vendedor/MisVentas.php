<?php

namespace App\Livewire\Vendedor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedido;
use App\Services\VentaService;

class MisVentas extends Component
{
    use WithPagination;

    public $search = '';
    public $pedidoSeleccionado; 
    public $mostrarModal = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Inyectamos el VentaService aquí
    public function render(VentaService $ventaService) 
    {
        // Consumimos el método desde el nuevo servicio
        $ventas = $ventaService->obtenerVentasPorVendedor(auth()->id(), $this->search);

        return view('livewire.vendedor.mis-ventas', [
            'datos' => $ventas
        ])->layout('layouts.app');
    }

    public function verDetalle($id_pedido)
    {
        $vendedorId = auth()->id();

        // Mantenemos la seguridad del modal: solo carga los productos de este vendedor
        $this->pedidoSeleccionado = Pedido::with(['user', 'detallePedidos' => function ($query) use ($vendedorId) {
            $query->whereHas('producto', function ($q) use ($vendedorId) {
                $q->where('id_user', $vendedorId);
            })->with('producto');
        }])->findOrFail($id_pedido);

        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
        $this->reset('pedidoSeleccionado');
    }
}