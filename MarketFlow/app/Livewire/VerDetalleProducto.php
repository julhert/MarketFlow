<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\DetalleProductoService;
use App\Services\CarritoService;

class VerDetalleProducto extends Component
{
    public $producto;
    public $cantidad = 1;
    public function mount(int $id, DetalleProductoService $detalleService)
    {
        $this->producto = $detalleService->getProductoForId($id);
    }

    public function agregar(CarritoService $carritoService)
    {
        try {

            $carritoService->addItem($this->producto->id_producto, $this->cantidad);

            $this->dispatch('carrito-actualizado');

            $this->dispatch('abrir-carrito');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.ver-detalle-producto') -> layout('layouts.app');
    }
}
