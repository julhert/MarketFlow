<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Mis Compras') }}
            </h2>
            <div class="text-sm text-gray-500">
                Bienvenido de nuevo, {{ explode(' ', Auth::user()->name)[0] }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8">

                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-gray-800">Historial de Pedidos</h3>
                    <a href="{{ route('catalogo') }}" class="bg-[#5C7AA3] hover:bg-[#274472] text-white px-5 py-2.5 rounded-md text-sm font-semibold transition">
                        Seguir comprando
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pedido</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600">
                            @forelse($pedidos as $pedido)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        #{{ $pedido->folio }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $pedido->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        ${{ number_format($pedido->totalCompra, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Entregado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <button wire:click="verDetalle({{ $pedido->id_pedido }})" class="text-gray-400 hover:text-indigo-600">
                                            <x-heroicon-o-eye class="w-5 h-5"/>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        Aún no has realizado ninguna compra.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between items-center text-sm text-gray-400">
                    <span>
                        Mostrando {{ $pedidos->firstItem() ?? 0 }} a {{ $pedidos->lastItem() ?? 0 }} de {{ $pedidos->total() }} pedidos
                    </span>

                    @if ($pedidos->hasPages())
                        <div class="flex rounded-md shadow-sm">

                            {{-- Botón Anterior --}}
                            @if ($pedidos->onFirstPage())
                                <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-700 bg-gray-800 text-sm font-medium text-gray-500 cursor-not-allowed">
                                    &laquo;
                                </span>
                            @else
                                <button wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-700 bg-gray-800 text-sm font-medium text-gray-300 hover:bg-gray-700 transition">
                                    &laquo;
                                </button>
                            @endif

                            {{-- Números de Páginas --}}
                            @foreach ($pedidos->getUrlRange(1, $pedidos->lastPage()) as $page => $url)
                                @if ($page == $pedidos->currentPage())
                                    {{-- Página Activa (Estética oscura que pidieron) --}}
                                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-700 bg-[#1e293b] text-sm font-medium text-white z-10 focus:outline-none">
                                        {{ $page }}
                                    </button>
                                @else
                                    {{-- Páginas Secundarias --}}
                                    <button wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 border border-gray-700 bg-gray-800 text-sm font-medium text-gray-300 hover:bg-gray-700 transition">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach

                            {{-- Botón Siguiente --}}
                            @if ($pedidos->hasMorePages())
                                <button wire:click="nextPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-700 bg-gray-800 text-sm font-medium text-gray-300 hover:bg-gray-700 transition">
                                    &raquo;
                                </button>
                            @else
                                <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-700 bg-gray-800 text-sm font-medium text-gray-500 cursor-not-allowed">
                                    &raquo;
                                </span>
                            @endif

                        </div>
                    @endif
                </div>

                @if($mostrarModal && $pedidoSeleccionado)
                    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="cerrarModal()"></div>

                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h3 class="text-lg font-bold mb-4">Detalle del Pedido: #{{ $pedidoSeleccionado->folio }}</h3>

                                    <div class="space-y-4">
                                        @foreach($pedidoSeleccionado->detallePedidos as $detalle)
                                        <div class="flex items-center justify-between border-b pb-2">
                                            <div class="flex items-center gap-3">
                                                {{-- Aplicamos tu lógica de imagen por defecto --}}
                                                <img src="{{ $detalle->producto->imagenes->first() ? asset('storage/' . $detalle->producto->imagenes->first()->rutaImagen) : asset('img/default.png') }}"
                                                    class="w-12 h-12 object-cover rounded">
                                                <div>
                                                    <p class="font-semibold text-sm">{{ $detalle->producto->nombre }}</p>
                                                    <p class="text-xs text-gray-500">Cantidad: {{ $detalle->cantidad }}</p>
                                                </div>
                                            </div>
                                            <p class="font-bold">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</p>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-6 text-right">
                                        <p class="text-xl font-extrabold text-orange-600">Total: ${{ number_format($pedidoSeleccionado->totalCompra, 2) }}</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" wire:click="cerrarModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
