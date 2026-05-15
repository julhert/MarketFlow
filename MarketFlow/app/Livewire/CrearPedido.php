<?php

namespace App\Livewire;

use App\Services\DireccionService;
use App\Http\Requests\PedidoRequest;
use App\Services\PedidoService;
use App\Models\Carrito;
use App\Models\Pedido;
use Livewire\Component;

class CrearPedido extends Component
{
    public function render()
    {
        return view('livewire.pedidos.crear-pedido', [
                    'direcciones' => $this->getDireccionesList()
                    ])->layout('layouts.app');
    }

    // Función para obtener las direcciones del usuario autenticado
    protected function getDireccionesList()
    {
        return app(DireccionService::class)
            ->getMiDireccion()
            ->map(function ($direccion) {
                return [
                    'id' => $direccion->id,
                    'texto' => "Calle: {$direccion->calle}, #{$direccion->numero_ext}, Colonia: {$direccion->colonia}, CP: {$direccion->codigo_postal}"
                ];
            });
    }

    public function confirmarCompra(PedidoService $pedidoService)
    {
        // Validamos
        $this->validate((new PedidoRequest())->rules());

        // Obtenemos los productos reales del carrito (no los de prueba)
        $items = Carrito::where('id_users', auth()->id())->with('producto')->get();

        if ($items->isEmpty()) {
            session()->flash('error', 'Tu carrito está vacío.');
            return;
        }

        // Ejecutamos la lógica a través del Service
        $pedido = $pedidoService->crearPedidoCompleto([
            'id_direccion' => $this->id_direccion, // El valor del radiobutton
            'metodoPago'   => $this->metodoPago,
            'totalCompra'  => $this->totalDefinitivo,
        ], $items);

        if ($pedido) {
            session()->flash('message', '¡Pedido MF-' . $pedido->folio . ' creado con éxito!');
            return redirect()->route('mis-compras'); // O a la vista de éxito
        }
    }
}
