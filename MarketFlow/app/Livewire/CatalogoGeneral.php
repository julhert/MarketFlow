<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use Illuminate\Support\Facades\DB; // Necesario para traer las categorías

class CatalogoGeneral extends Component
{
    use WithPagination;

    public $busqueda = '';
    public $categoria_seleccionada = null; // Guardará el ID de la categoría activa

    // Si busca algo, regresamos a la página 1
    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    // Método para cambiar de categoría al hacer clic
    public function seleccionarCategoria($idCategoria)
    {
        $this->categoria_seleccionada = $idCategoria;
        $this->resetPage(); // Reiniciamos paginación al filtrar
    }

    public function render()
    {
        // Traemos las categorías para la barra de navegación
        $categorias = DB::table('categorias')->get();

        // Filtramos los productos dinámicamente
        $productos = Producto::with(['imagenes' =>function($query) {
                            $query->where('portada', 1);
                        }])->where('activo', 1)
                            ->where('stock', '>', 0)
                            ->when($this->busqueda, function($query) {
                                $query->where('nombre', 'like', '%' . $this->busqueda . '%');
                            })
                            // ¡Aquí está la magia del filtro por categoría!
                            ->when($this->categoria_seleccionada, function($query) {
                                $query->where('id_categoria', $this->categoria_seleccionada);
                            })
                            ->latest()
                            ->paginate(12);

        return view('livewire.catalogo-general', [
            'productos' => $productos,
            'categorias' => $categorias
        ])->layout('layouts.guest');
    }
}
