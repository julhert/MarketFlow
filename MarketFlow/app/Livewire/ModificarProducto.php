<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\Producto;
use App\Models\ImagenProducto;
use App\Http\Requests\ProductoRequest;
use App\Services\ProductoService;
use Illuminate\Support\Facades\DB;

class ModificarProducto extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $id_producto_editar;
    public $nombre, $id_categoria = '', $descripcion, $precio, $stock, $activo = 1;
    
    public $portada_actual;
    public $fotos_extra_actuales = [];

    public $portada;
    public $fotos_extra = [];

    #[On('editar-producto')]
    public function cargarProductoParaEditar($id)
    {
        \Log::info('>>> editar-producto recibido, id: ' . $id);
        
        $producto = Producto::where('id_producto', $id)->first();
        if (!$producto) { return; }

        $this->id_producto_editar = $producto->id_producto;
        $this->nombre = $producto->nombre;
        $this->id_categoria = $producto->id_categoria;
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->stock = $producto->stock;
        $this->activo = $producto->activo;
        
        try {
            $portadaObj = ImagenProducto::where('id_producto', $producto->id_producto)->where('portada', 1)->first();
            $this->portada_actual = $portadaObj ? $portadaObj->rutaImagen : null;
            
            $this->fotos_extra_actuales = ImagenProducto::where('id_producto', $producto->id_producto)->where('portada', 0)->pluck('rutaImagen')->toArray();
        } catch (\Exception $e) {
            \Log::error("Error al buscar imágenes: " . $e->getMessage());
        }

        // Limpiamos los archivos nuevos
        $this->portada = null;
        $this->fotos_extra = [];

        // Encendemos el formulario
        $this->isOpen = true;
    }

    public function actualizar(ProductoService $productoService)
    {
        $request = new ProductoRequest();
        $datosValidados = $this->validate($request->rules());

        $portadaFile = $this->portada;
        $galeriaFiles = array_filter($this->fotos_extra);

        unset($datosValidados['portada'], $datosValidados['fotos_extra']);

        $productoService->actualizarProducto(
            $this->id_producto_editar, 
            $datosValidados, 
            $portadaFile, 
            $galeriaFiles
        );

        $this->isOpen = false;
        
        // Redirigimos para asegurar que la tabla se actualice con los nuevos datos
        return redirect()->route('dashboard'); 
    }

    public function render()
    {
        $categorias = DB::table('categorias')->get();
        return view('livewire.modificar-producto', ['categorias' => $categorias]);
    }
}