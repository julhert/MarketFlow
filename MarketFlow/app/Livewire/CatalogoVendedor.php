<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CatalogoVendedor extends Component
{
    use WithPagination;

    public $mostrandoFormulario = false;

    protected $listeners = [
        'producto-guardado' => '$refresh',
        'producto-actualizado' => '$refresh'
    ];

    public function toggleStatus($productoId)
    {
        $producto = Producto::where('id_user', Auth::id())
            ->where('id_producto', $productoId)
            ->first();

        if ($producto) {
            $producto->activo = !$producto->activo;
            $producto->save();
        }
    }

    // 1. Apaga la tabla y lanza el evento de Editar
    public function abrirEdicion(int $id): void
    {
        $this->mostrandoFormulario = true;
        $this->dispatch('editar-producto', id: $id);
    }

    // 2. Apaga la tabla y lanza el evento de Crear
    public function abrirCreacion(): void
    {
        $this->mostrandoFormulario = true;
        $this->dispatch('abrir-formulario');
    }

    // 3. Escucha cuando le das a Cancelar para prender la tabla de nuevo
    #[On('cerrar-formulario')]
    public function restaurarTabla(): void
    {
        $this->mostrandoFormulario = false;
    }

    public function render()
    {
        $productos = Producto::where('id_user', Auth::id())
            ->latest()
            ->paginate(5);

        return view('livewire.catalogo-vendedor', [
            'productos' => $productos
        ])->layout('layouts.app');
    }
}