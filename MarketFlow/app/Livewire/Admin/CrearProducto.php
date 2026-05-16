<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria; // Para llenar el select
use Livewire\WithFileUploads; // Importante para las imágenes

class CrearProducto extends Component
{
    use WithFileUploads;

    // Propiedades del formulario
    public $nombre, $descripcion, $precio, $stock, $id_categoria, $imagen;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'id_categoria' => 'required|exists:categorias,id_categoria',
        'imagen' => 'nullable|image|max:2048', // Máximo 2MB
    ];

    public function Guardar()
    {
        $this->validate();

        // Lógica de guardado de imagen
        $rutaImagen = null;
        if ($this->imagen) {
            $rutaImagen = $this->imagen->store('productos', 'public');
        }

        // CREACIÓN DEL PRODUCTO
        Producto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'id_categoria' => $this->id_categoria,
            'id_user' => auth()->id(),
            'imagen' => $rutaImagen,
            'activo' => 1
        ]);

        session()->flash('message', 'Producto creado exitosamente.');
        return $this->redirectRoute('admin.productos', navigate: true);
    }

    public function Cancelar()
    {
        return $this->redirectRoute('admin.productos', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.crear-producto', [
            'categorias' => Categoria::all()
        ])->layout('layouts.app');
    }
}