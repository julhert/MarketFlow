<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Mis Productos</h2>
            {{-- Agregamos @click para disparar el evento de Alpine --}}
            <button @click="$dispatch('abrir-formulario')"
                class="bg-[#274472] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#1B3454] transition shadow-sm">
                + Nuevo Producto
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Producto</th>
                        <th class="px-6 py-4">Precio</th>
                        <th class="px-6 py-4">Stock</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($productos as $producto)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-gray-600">${{ number_format($producto->precio, 2) }}</div>
                            </td>
                            <td class="px-6 py-5">
                                @if ($producto->stock > 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20">
                                        {{ $producto->stock }} disponibles
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">
                                        Agotado
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button wire:click="toggleStatus({{ $producto->id_producto }})"
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#274472] focus:ring-offset-2 {{ $producto->activo ? 'bg-[#00AB1F]' : 'bg-gray-200' }}">
                                    <span
                                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $producto->activo ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                </button>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button @click="$dispatch('editar-producto', { id: {{ $producto->id_producto }} })"
                                    class="inline-block text-gray-400 hover:text-[#274472] transition-colors duration-200"
                                    title="Modificar Producto">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 bg-gray-50 rounded-b-lg">
                                Aún no tienes productos en tu catálogo.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $productos->links() }}
        </div>

    </div>
</div>
