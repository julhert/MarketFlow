<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CrearUsuarios extends Component
{
    // Propiedades públicas para el formulario
    public $name;
    public $email;
    public $password;
    public $rol;

    // Reglas de validación para un nuevo registro
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'rol' => 'required|string'
    ];

    public function Guardar()
    {
        // 1. Validamos los datos ingresados
        $this->validate();

        // 2. Creamos el nuevo usuario con la contraseña encriptada
        $usuario = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // 3. Le asignamos su rol (Spatie Permissions)
        if ($this->rol) {
            $usuario->assignRole($this->rol);
        }

        // 4. Mandamos mensaje de éxito a la sesión
        session()->flash('message', 'Usuario registrado con éxito.');

        // 5. Redireccionamos a la tabla con efecto SPA (wire:navigate)
        return $this->redirectRoute('admin.usuarios', navigate: true);
    }

    public function Cancelar()
    {
        // Si cancela, regresa directo a la consulta de usuarios
        return $this->redirectRoute('admin.usuarios', navigate: true);
    }

    public function render()
    {
        // Renderiza usando el layout principal global de la app
        return view('livewire.admin.crear-usuarios')
            ->layout('layouts.app');
    }
}