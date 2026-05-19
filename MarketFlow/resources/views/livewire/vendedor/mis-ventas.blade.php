<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

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
    
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 border-b border-gray-100 pb-4 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Mis Ventas</h2>
            
            <div class="w-full md:w-80 relative">
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="w-full border-gray-300 focus:border-[#274472] focus:ring focus:ring-[#274472] focus:ring-opacity-50 rounded-md shadow-sm pl-10 text-sm"
                    placeholder="Buscar por folio o cliente...">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Folio</th>
                        <th class="px-6 py-4">Cliente</th>
                        <th class="px-6 py-4">Tus Ingresos</th>
                        <th class="px-6 py-4">Fecha</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($datos as $item)
                        @php
                            // Calculamos tu ganancia
                            $gananciaVendedor = $item->detallePedidos->sum(function($d) {
                                return $d->cantidad * $d->precio_unitario;
                            });
                            $estadoReal = $item->estado ?? $item->status ?? 'Completado';
                        @endphp

                        <tr wire:key="venta-{{ $item->id_pedido }}" class="hover:bg-gray-50 transition-colors duration-200">
                            
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-gray-900">{{ $item->folio }}</div>
                            </td>
                            
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-gray-700">{{ $item->user->name ?? 'Cliente Eliminado' }}</div>
                            </td>
                            
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-green-600">${{ number_format($gananciaVendedor, 2) }}</div>
                            </td>
                            
                            <td class="px-6 py-5 text-sm text-gray-500">
                                {{ $item->created_at->format('d/m/Y') }} <span class="text-xs text-gray-400 ml-1">{{ $item->created_at->format('H:i') }}</span>
                            </td>
                            
                            <td class="px-6 py-5 text-center">
                                @if(strtolower($estadoReal) == 'completado' || strtolower($estadoReal) == 'pagado')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20">
                                        {{ $estadoReal }}
                                    </span>
                                @elseif(strtolower($estadoReal) == 'pendiente')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                                        {{ $estadoReal }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-700 ring-1 ring-inset ring-gray-600/20">
                                        {{ $estadoReal }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button wire:click="verDetalle({{ $item->id_pedido }})"
                                    class="inline-block text-gray-400 hover:text-[#274472] transition-colors duration-200"
                                    title="Ver detalle del pedido">
                                    <svg xmlns="http://www.w3.org/2001/svg" class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-gray-50 rounded-b-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Aún no tienes ventas registradas o la búsqueda no coincide.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $datos->links() }}
        </div>
    </div>

    @if($mostrarModal && $pedidoSeleccionado)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500/75 backdrop-blur-sm px-4 transition-opacity">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl overflow-hidden flex flex-col max-h-[90vh]">

                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-b border-gray-200">
                    <h3 class="text-gray-800 font-bold text-lg">
                        Detalle de Venta: {{ $pedidoSeleccionado->folio }}
                    </h3>
                    <button wire:click="cerrarModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 bg-white p-5 rounded-lg border border-gray-200">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Cliente</p>
                            <p class="text-gray-900 font-medium">{{ $pedidoSeleccionado->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Fecha</p>
                            <p class="text-gray-900 font-medium">{{ $pedidoSeleccionado->created_at->format('d/m/Y - H:i') }}</p>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider border-b border-gray-100 pb-2">
                        Productos Vendidos
                    </h4>
                    
                    <div class="space-y-3">
                        @php $gananciaTotal = 0; @endphp
                        @foreach($pedidoSeleccionado->detallePedidos as $detalle)
                            @php 
                                $subtotal = $detalle->cantidad * $detalle->precio_unitario;
                                $gananciaTotal += $subtotal;
                            @endphp
                            <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-colors">
                                <div class="flex items-center gap-4">
                                    @if($detalle->producto && $detalle->producto->imagen)
                                        <img src="{{ asset('storage/' . $detalle->producto->imagen) }}" class="w-12 h-12 object-cover rounded shadow-sm border border-gray-200">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded border border-gray-200 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">{{ $detalle->producto->nombre ?? 'Producto Eliminado' }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $detalle->cantidad }} u. &times; ${{ number_format($detalle->precio_unitario, 2) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">${{ number_format($subtotal, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                    <p class="text-sm text-gray-600 font-bold uppercase tracking-wider">Total Ingresos:</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($gananciaTotal, 2) }}</p>
                </div>
            </div>
        </div>
    @endif

</div>