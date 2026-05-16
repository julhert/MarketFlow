<div class="flex h-screen bg-gray-50 text-gray-900 font-sans relative">
    
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col py-8 shadow-sm z-10 shrink-0">

        <nav class="w-full px-4 space-y-2">
            <a href="{{ route('admin.panel') ?? '#' }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <a href="{{ route('admin.usuarios') ?? '#' }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios
            </a>
            
            <a href="{{ route('admin.productos') ?? '#' }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Productos
            </a>
            
            <a href="{{ route('admin.ventas') }}" class="flex items-center gap-3 w-full px-4 py-3 bg-[#274472]/10 text-[#274472] font-bold rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Ventas
            </a>
            
            <a href="{{ route('categorias') ?? '#' }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Categorias
            </a>
        </nav>

        <div class="mt-auto w-full px-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-3 text-gray-500 font-semibold rounded-xl hover:bg-red-50 hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <div class="flex-1 overflow-y-auto p-10 bg-[#F4F6F9]">
            
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
                
                <h5 class="font-title text-[25px] text-center text-brand-blue-400 uppercase tracking-widest mb-6">
                    Historial de Ventas
                </h5>

                <div class="flex justify-center items-center gap-4 mb-8">
                    <label class="font-body text-brand-blue-300 font-semibold">Búsqueda</label>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="font-body w-[500px] border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Buscar por número de folio o nombre de cliente...">
                </div>

                <div class="mt-4">
                    @if ($datos == null || $datos->isEmpty())
                        <div class="font-body text-center py-10 bg-brand-blue-50/20 rounded-xl border-2 border-dashed border-brand-blue-100 text-brand-blue-200">
                            <p class="text-xl">No se encontraron registros de ventas...</p>
                        </div>
                    @else
                        <div class="overflow-hidden rounded-xl shadow-xl border border-brand-blue-100">
                            <table class="w-full text-left bg-white border-collapse">
                                <thead class="bg-brand-blue-400 text-white font-title text-sm uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4 text-center">Folio</th>
                                        <th class="px-6 py-4">Cliente</th>
                                        <th class="px-6 py-4 text-center">Total</th>
                                        <th class="px-6 py-4 text-center">Fecha</th>
                                        <th class="px-6 py-4 text-center">Estado</th>
                                        <th class="px-6 py-4 text-center">Detalles</th>
                                    </tr>
                                </thead>

                                <tbody class="font-body text-[16px] text-main-black divide-y divide-gray-100">
                                    @foreach ($datos as $item)
                                        @php
                                            // Calculamos el total real sumando los detalles (cantidad * precio_unitario)
                                            $totalReal = $item->total > 0 ? $item->total : $item->detallePedidos->sum(function($detalle) {
                                                return $detalle->cantidad * $detalle->precio_unitario;
                                            });

                                            // Verificamos si la columna se llama 'estado', 'status', o le ponemos 'Completado' por defecto
                                            $estadoReal = $item->estado ?? $item->status ?? 'Completado';
                                        @endphp

                                        <tr class="hover:bg-brand-blue-50/30 transition-colors duration-200">
                                            <td class="px-6 py-4 text-center font-bold text-gray-600">
                                                #{{ $item->id_pedido }}
                                            </td>
                                            <td class="px-6 py-4 font-semibold text-brand-blue-300">
                                                {{ $item->user->name ?? 'Cliente Eliminado' }}
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold text-gray-800">
                                                ${{ number_format($totalReal, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-center text-gray-500 text-sm">
                                                {{ $item->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if(strtolower($estadoReal) == 'completado' || strtolower($estadoReal) == 'pagado')
                                                    <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-xs font-bold uppercase border border-green-200">
                                                        {{ $estadoReal }}
                                                    </span>
                                                @elseif(strtolower($estadoReal) == 'pendiente')
                                                    <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-xs font-bold uppercase border border-yellow-200">
                                                        {{ $estadoReal }}
                                                    </span>
                                                @else
                                                    <span class="bg-gray-100 text-gray-700 px-4 py-1 rounded-full text-xs font-bold uppercase border border-gray-200">
                                                        {{ $estadoReal }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <button wire:click="verDetalle({{ $item->id_pedido }})"
                                                   class="inline-block p-2 bg-[#274472] text-white rounded-lg hover:scale-110 transition-transform shadow-sm focus:outline-none"
                                                   title="Ver detalles de los productos">
                                                    <svg xmlns="http://www.w3.org/2001/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $datos->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </main>

    @if($mostrarModal && $pedidoSeleccionado)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-opacity">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden flex flex-col max-h-[90vh] mx-4 animate-fade-in-up">

                <div class="bg-[#274472] px-8 py-5 flex justify-between items-center shrink-0">
                    <h3 class="text-white font-title text-xl uppercase tracking-widest font-bold">
                        Detalles del Pedido #{{ $pedidoSeleccionado->id_pedido }}
                    </h3>
                    <button wire:click="cerrarModal" class="text-white hover:text-red-300 transition-colors focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-8 overflow-y-auto font-body bg-gray-50">
                    
                    <div class="grid grid-cols-2 gap-6 mb-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                        <div>
                            <p class="text-sm text-[#274472] font-bold mb-1 uppercase tracking-wider">Cliente</p>
                            <p class="text-gray-900 font-black text-lg">{{ $pedidoSeleccionado->user->name ?? 'N/A' }}</p>
                            <p class="text-gray-500 text-sm">{{ $pedidoSeleccionado->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[#274472] font-bold mb-1 uppercase tracking-wider">Fecha de Compra</p>
                            <p class="text-gray-900 font-semibold">{{ $pedidoSeleccionado->created_at->format('d/m/Y') }}</p>
                            <p class="text-gray-500 text-sm">{{ $pedidoSeleccionado->created_at->format('h:i A') }}</p>
                        </div>
                    </div>

                    <h4 class="text-lg font-black text-[#274472] mb-4 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Artículos Comprados
                    </h4>
                    
                    <div class="space-y-4">
                        @foreach($pedidoSeleccionado->detallePedidos as $detalle)
                            <div class="flex items-center justify-between bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-4">
                                    
                                    @if($detalle->producto && $detalle->producto->imagen)
                                        <img src="{{ asset('storage/' . $detalle->producto->imagen) }}" alt="Producto" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <div class="w-16 h-16 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-200">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-bold text-gray-800 text-lg">{{ $detalle->producto->nombre ?? 'Producto Eliminado' }}</p>
                                        <p class="text-sm text-gray-500 font-semibold">
                                            {{ $detalle->cantidad }} unidad(es) &times; ${{ number_format($detalle->precio_unitario, 2) }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Subtotal</p>
                                    <p class="font-black text-[#274472] text-xl">
                                        ${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white px-8 py-6 border-t border-gray-200 flex justify-between items-center shrink-0 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                    <p class="text-lg text-gray-500 font-bold uppercase tracking-widest">Total Pagado:</p>
                    <p class="text-3xl font-black text-green-600">${{ number_format($pedidoSeleccionado->total, 2) }}</p>
                </div>

            </div>
        </div>
    @endif

</div>