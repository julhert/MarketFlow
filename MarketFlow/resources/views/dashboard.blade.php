<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Mi Panel de Vendedor') }}
            </h2>
            <div class="text-sm text-gray-500">
                Bienvenido de nuevo, {{ explode(' ', Auth::user()->name)[0] }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100" 
         x-data="{ vista: 'tabla' }" 
         @abrir-formulario.window="vista = 'formulario'" 
         @editar-producto.window="vista = 'formulario'"
         @cerrar-formulario.window="vista = 'tabla'">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div x-show="vista === 'tabla'">
                <livewire:catalogo-vendedor />
            </div>

            <div x-show="vista === 'formulario'" style="display: none;">
                <livewire:agregar-producto />
            </div>

        </div>
    </div>
</x-app-layout>