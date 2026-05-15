<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\PanelAdminService;

class Panel extends Component
{
    public $totalUsuarios = 0;
    public $totalProductos = 0;
    public $totalVendedores = 0;
    public $totalClientes = 0;
    public $totalPedidos = 0;

    public $busqueda = '';

    public function mount(PanelAdminService $servicio)
    {
        // Consumiendo el Service que te pasó tu equipo
        $this->totalUsuarios = $servicio->getCountUsers();
        $this->totalProductos = $servicio->getCountProductos();
        $this->totalVendedores = $servicio->getCountVendedores();
        $this->totalClientes = $servicio->getCountClientes();
        $this->totalPedidos = $servicio->getCountPedidos();
    }

    public function render()
    {
        return view('livewire.admin.panel')
            ->layout('layouts.app'); // Ajusta si tienes un layout diferente para el admin
    }
}