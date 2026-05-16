<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; // Para poder borrar la imagen anterior

class ModificarProducto extends Component
{
    use WithFileUploads;

    // Propiedades del formulario
    public $producto_id, $nombre, $descripcion, $precio, $stock, $id_categoria;
    public $imagen; // Para atrapar la NUEVA imagen si sube una
    public $imagen_actual; // Para mostrar la imagen que ya tiene en la BD

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'imagen' => 'nullable|image|max:2048', // La imagen nueva es opcional
        ];
    }

    public function mount($id)
    {
        // Buscamos el producto
        $producto = Producto::findOrFail($id);
        
        // Ajusta "id_producto" por el nombre real de tu llave primaria si es diferente
        $this->producto_id = $producto->id_producto ?? $producto->id; 
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->stock = $producto->stock;
        $this->id_categoria = $producto->id_categoria;
        $this->imagen_actual = $producto->imagen; // Guardamos la ruta actual
    }

    public function editar()
    {
        $this->validate();

        $producto = Producto::findOrFail($this->producto_id);
        
        // Lógica para actualizar la imagen solo si subió una nueva
        if ($this->imagen) {
            // Eliminamos la imagen vieja del servidor para no acumular basura
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
            // Guardamos la nueva y actualizamos el campo
            $rutaImagen = $this->imagen->store('productos', 'public');
            $producto->imagen = $rutaImagen;
        }

        // Actualizamos el resto de los campos
        $producto->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'id_categoria' => $this->id_categoria,
        ]);

        session()->flash('message', 'Producto actualizado exitosamente.');
        return $this->redirectRoute('admin.productos', navigate: true);
    }

    public function Cancelar()
    {
        return $this->redirectRoute('admin.productos', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.modificar-producto', [
            'categorias' => Categoria::all()
        ])->layout('layouts.app');
    }
}