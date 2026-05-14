<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Http\Requests\ProductoRequest;
use App\Services\ProductoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgregarProducto extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $nombre, $id_categoria = '', $descripcion, $precio, $stock, $activo = 1;
    public $portada, $fotos_extra = [];

    #[On('abrir-formulario')]
    public function mostrarFormulario()
    {
        $this->reset(['nombre', 'id_categoria', 'descripcion', 'precio', 'stock', 'portada', 'fotos_extra']);
        $this->activo = 1;
        $this->isOpen = true;
    }

    #[On('cerrar-formulario'), On('editar-producto')]
    public function cerrarFormulario()
    {
        $this->isOpen = false;
    }

    public function guardar(ProductoService $productoService)
    {
        $request = new ProductoRequest();
        $reglas = $request->rules();

        // 1. Evitamos que falle si el request pide el id_user
        unset($reglas['id_user']);

        // 2. Validamos
        $datosValidados = $this->validate($reglas);

        $portadaFile = $this->portada;
        $galeriaFiles = array_filter($this->fotos_extra);

        unset($datosValidados['portada'], $datosValidados['fotos_extra']);
        
        // 3. Asignamos el dueño (En este caso, Pedrito)
        $datosValidados['id_user'] = Auth::id();

        $productoService->guardarProducto($datosValidados, $portadaFile, $galeriaFiles);

        $this->isOpen = false;
        return redirect()->route('dashboard'); 
    }

    public function render()
    {
        $categorias = DB::table('categorias')->get();
        return view('livewire.agregar-producto', ['categorias' => $categorias]);
    }
}