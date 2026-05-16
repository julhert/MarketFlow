<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role; 

class ModificarUsuarios extends Component
{
    // Propiedades públicas conectadas con el wire:model de la vista
    public $usuario_id;
    public $name;
    public $email;
    public $rol;

    // Reglas de validación
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            // El unique ignora el email actual del usuario para que no marque error al guardar
            'email' => 'required|email|max:255|unique:users,email,' . $this->usuario_id,
            'rol' => 'required|string'
        ];
    }

    // El método mount recibe el ID de la URL automáticamente
    public function mount($id)
    {
        $usuario = User::findOrFail($id);
        
        // Llenamos las propiedades con los datos actuales
        $this->usuario_id = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        
        // Obtenemos el nombre del rol que tiene actualmente asignado
        $this->rol = $usuario->roles->first()->name ?? ''; 
    }

    public function editar()
    {
        // 1. Validamos los datos
        $this->validate();

        // 2. Buscamos al usuario en la BD
        $usuario = User::findOrFail($this->usuario_id);
        
        // 3. Actualizamos sus datos básicos
        $usuario->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // 4. Actualizamos su rol (Spatie se encarga de borrar el anterior y poner el nuevo)
        if ($this->rol) {
            $usuario->syncRoles([$this->rol]);
        }

        // 5. Redirigimos de vuelta a la tabla con un mensaje de éxito
        session()->flash('message', 'Usuario actualizado con éxito.');
        
        // Usamos navigate: true para que la transición sea suave como SPA
        return $this->redirectRoute('admin.usuarios', navigate: true);
    }

    public function Cancelar()
    {
        // Si se arrepiente, lo mandamos de regreso a la tabla
        return $this->redirectRoute('admin.usuarios', navigate: true);
    }

    public function render()
    {
        // Renderizamos la vista usando el layout.app que te funcionó de maravilla
        return view('livewire.admin.modificar-usuarios')
            ->layout('layouts.app'); 
    }
}