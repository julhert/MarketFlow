<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; // <-- ¡Esta es la magia para escuchar eventos!
use App\Models\Producto; // O Producto, revisa tu modelo
use App\Http\Requests\ProductoRequest; // Para reutilizar las reglas de validación
use App\Services\ProductoService; // El service que creamos para manejar la lógica
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

    public function guardar(ProductoService $productoService)
    {
        // 1. Jalamos las reglas del ProductoRequest para no repetirlas
        $request = new ProductoRequest();

        // 2. Validamos los datos del componente
        $datosValidados = $this->validate($request->rules());

        // Separamos los archivos de los datos de la tabla 'productos'
        $portadaFile = $this->portada;
        $galeriaFiles = array_filter($this->fotos_extra);

        // Limpiamos el array para el Modelo Producto
        unset($datosValidados['portada'], $datosValidados['fotos_extra']);

        // 3. Agregamos el id_user manual (mientras se arregla el login)
        $datosValidados['id_user'] = 1;

        // 4. Mandamos al Service
        $productoService->guardarProducto($datosValidados, $portadaFile, $galeriaFiles);

        return redirect()->route('vendedor.productos');
    }

    public function render()
    {
        $categorias = DB::table('categorias')->get();
        return view('livewire.agregar-producto', ['categorias' => $categorias])->layout('layouts.app');
    }
}
