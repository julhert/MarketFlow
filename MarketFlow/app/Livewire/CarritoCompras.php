<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\CarritoService;

class CarritoCompras extends Component
{
    public $isOpen = false;
    public $mensajeError = '';

    // Permite abrir el carrito desde la barra de navegación u otro lugar
    #[On('abrir-carrito')]
    public function abrir()
    {
        $this->isOpen = true;
        $this->mensajeError = '';
    }

    #[On('cerrar-carrito')]
    public function cerrar()
    {
        $this->isOpen = false;
    }

    // Opcional: Escucha si alguien le da a "Comprar" en un producto para agregarlo y abrir el panel
    #[On('agregar-al-carrito')]
    public function agregarAlCarrito($idProducto, CarritoService $servicio)
    {
        try {
            $this->mensajeError = '';
            $servicio->addItem($idProducto, 1);
            $this->isOpen = true; 
        } catch (\Exception $e) {
            $this->mensajeError = $e->getMessage();
        }
    }

    public function aumentarCantidad($idItem, $cantidadActual, CarritoService $servicio)
    {
        try {
            $this->mensajeError = '';
            $servicio->updateCantidad($idItem, $cantidadActual + 1);
        } catch (\Exception $e) {
            $this->mensajeError = $e->getMessage();
        }
    }

    public function restarCantidad($idItem, $cantidadActual, CarritoService $servicio)
    {
        try {
            $this->mensajeError = '';
            if ($cantidadActual > 1) {
                $servicio->updateCantidad($idItem, $cantidadActual - 1);
            } else {
                // Si resta a 0, lo eliminamos
                $servicio->eliminarItem($idItem);
            }
        } catch (\Exception $e) {
            $this->mensajeError = $e->getMessage();
        }
    }

    public function eliminar($idItem, CarritoService $servicio)
    {
        $this->mensajeError = '';
        $servicio->eliminarItem($idItem);
    }

    public function vaciar(CarritoService $servicio)
    {
        $this->mensajeError = '';
        $servicio->vaciarCarrito();
    }

    public function render(CarritoService $servicio)
    {
        $items = [];
        $total = 0;

        // Por eficiencia, solo consultamos la BD si el carrito está abierto
        if ($this->isOpen) {
            $items = $servicio->getCarrito();
            $total = $servicio->calcularTotal($items);
        }

        return view('livewire.carrito-compras', [
            'items' => $items,
            'total' => $total
        ]);
    }
}