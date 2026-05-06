<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Panel') }}
        </h2>
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