<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;

class VerProductos extends Component
{
    public $producto;
    public $cantidad = 1;

    public function mount($id)
    {
        // Buscamos por la llave primaria definida en tu tabla 'productos'
        $this->producto = Producto::where('id_producto', $id)->firstOrFail();
    }

    public function comprarAhora()
    {
        // 1. Validación de Stock
        if ($this->producto->stock < $this->cantidad) {
            session()->flash('error', 'No hay suficiente stock disponible.');
            return;
        }

        try {
            DB::beginTransaction();

            // 2. Crear el pedido principal (Lógica simplificada)
            // Aquí deberías tener la lógica para crear el registro en la tabla 'pedidos'
            $pedido = Pedido::create([
                'id_usuario' => auth()->id(), // Si hay autenticación
                'estado' => 'Pendiente',
                'total' => $this->producto->precio * $this->cantidad
            ]);

            // 3. Crear el detalle usando tu modelo 'DetallePedido'
            // Pasamos los campos definidos en tu $fillable
            DetallePedido::create([
                'id_pedido'       => $pedido->id_pedido,
                'id_producto'     => $this->producto->id_producto,
                'cantidad'        => $this->cantidad,
                'precio_unitario' => $this->producto->precio,
            ]);

            // 4. Descontar Stock
            $this->producto->decrement('stock', $this->cantidad);

            DB::commit();
            return redirect()->route('confirmacion.pedido', $pedido->id_pedido);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Ocurrió un error al procesar la compra.');
        }
    }

    public function render()
    {
        return view('livewire.ver-productos');
    }
}
