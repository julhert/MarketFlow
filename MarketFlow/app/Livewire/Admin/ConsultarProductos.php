<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\PanelAdminService;

class ConsultarProductos extends Component
{
    use WithPagination;

    public $search = '';

    // Este método asegura que al escribir en el buscador, regreses a la página 1
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function eliminar($id)
    {
        // Lógica para eliminar el producto
        \App\Models\Producto::destroy($id);
        
        session()->flash('message', 'Producto eliminado correctamente.');
    }

    public function render(PanelAdminService $servicio)
    {
        $datos = $servicio->getAllProductos($this->search); 

        return view('livewire.admin.consultar-productos', [
            'datos' => $datos
        ])->layout('layouts.app');
    }
}