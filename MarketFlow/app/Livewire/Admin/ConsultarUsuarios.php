<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\PanelAdminService;

class ConsultarUsuarios extends Component
{
    // Propiedad reactiva para el buscador
    public $search = '';

    // Método para eliminar un usuario
    public function eliminar($id)
    {
        // Aquí tu lógica para eliminar, por ejemplo:
        \App\Models\User::destroy($id);
        
        session()->flash('message', 'Usuario eliminado correctamente.');
    }

    public function render(PanelAdminService $servicio)
    {
        // Consumimos el servicio del equipo pasando el filtro de búsqueda
        $datos = $servicio->getAllUsers($this->search);

        return view('livewire.admin.consultar-usuarios', [
            'datos' => $datos
        ])->layout('layouts.app');
    }
}