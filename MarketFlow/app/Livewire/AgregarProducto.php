<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; 
use Livewire\Attributes\On; // <-- ¡Esta es la magia para escuchar eventos!
use App\Models\Producto; // O Producto, revisa tu modelo
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgregarProducto extends Component
{
    use WithFileUploads;

    public $id_producto_editar; 
    public $nombre, $id_categoria = '', $descripcion, $precio, $stock, $activo = 1;
    public $portada, $fotos_extra = [];

    // 1. Cuando hacen clic en "+ Nuevo Producto", reseteamos las variables
    #[On('abrir-formulario')]
    public function prepararNuevoProducto()
    {
        $this->reset(['id_producto_editar', 'nombre', 'id_categoria', 'descripcion', 'precio', 'stock', 'portada', 'fotos_extra']);
        $this->activo = 1;
    }

    // 2. Cuando hacen clic en el lápiz, recibimos el ID y llenamos los campos
    #[On('editar-producto')]
    public function cargarProductoParaEditar($id)
    {
        $this->id_producto_editar = $id;
        
        $producto = Producto::where('id_user', Auth::id())
                           ->where('id_producto', $id)
                           ->first();

        if ($producto) {
            $this->nombre = $producto->nombre;
            $this->id_categoria = $producto->id_categoria;
            $this->descripcion = $producto->descripcion;
            $this->precio = $producto->precio;
            $this->stock = $producto->stock;
            $this->activo = $producto->activo;
        }
    }

    public function guardar()
    {
        // 
    }

    public function render()
    {
        $categorias = DB::table('categorias')->get();
        return view('livewire.agregar-producto', ['categorias' => $categorias]);
    }
}