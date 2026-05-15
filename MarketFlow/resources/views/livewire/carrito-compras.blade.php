<div x-data="{ isOpen: $wire.entangle('isOpen') }">
    
    <div x-show="isOpen" 
         class="fixed inset-0 z-40" 
         @click="isOpen = false"
         style="display: none;">
    </div>

    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-200 origin-top-right" 
         x-transition:enter-start="opacity-0 transform scale-95" 
         x-transition:enter-end="opacity-100 transform scale-100" 
         x-transition:leave="transition ease-in duration-150 origin-top-right" 
         x-transition:leave-start="opacity-100 transform scale-100" 
         x-transition:leave-end="opacity-0 transform scale-95" 
         class="fixed top-20 right-4 sm:right-8 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl z-50 border border-gray-200 flex flex-col overflow-hidden"
         style="display: none;">
        
        <div class="px-5 py-3 border-b border-gray-100 bg-white flex justify-between items-center z-10">
            <h2 class="text-base font-bold text-[#274472] flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Mi Carrito
            </h2>
            <button @click="isOpen = false" class="text-gray-400 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-full p-1.5 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        @if($mensajeError)
            <div class="bg-red-50 p-2 m-2 text-xs text-red-700 font-medium rounded text-center">
                {{ $mensajeError }}
            </div>
        @endif

        <div class="overflow-y-auto bg-gray-50/80 max-h-96">
            @if(count($items) > 0)
                <div class="p-3 space-y-2">
                    @foreach($items as $item)
                        <div wire:key="cart-item-{{ $item->id_carrito }}" class="flex items-center gap-3 bg-white p-2 rounded-xl border border-gray-100 shadow-sm relative group">
                            
                            <button wire:click="eliminar({{ $item->id_carrito }})" class="absolute -top-1.5 -right-1.5 bg-white border border-gray-200 text-gray-400 hover:text-red-500 rounded-full p-1 shadow-sm opacity-0 group-hover:opacity-100 transition-opacity" title="Quitar">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-md border border-gray-100 bg-gray-50">
                                @php
                                    $portada = $item->producto->imagenes()->where('portada', 1)->first();
                                @endphp
                                @if($portada)
                                    <img src="{{ asset('storage/' . $portada->rutaImagen) }}" alt="{{ $item->producto->nombre }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-gray-300">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-1 flex-col justify-center">
                                <h3 class="text-sm font-bold text-gray-800 line-clamp-1 pr-4">{{ $item->producto->nombre }}</h3>
                                <p class="text-xs text-gray-500 mb-1">${{ number_format($item->producto->precio, 2) }} c/u</p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center border border-gray-200 rounded text-xs bg-gray-50">
                                        <button wire:click="restarCantidad({{ $item->id_carrito }}, {{ $item->cantidad }})" class="px-2 py-0.5 text-gray-600 hover:bg-gray-200 font-medium">-</button>
                                        <span class="px-2 py-0.5 font-bold border-x border-gray-200 bg-white">{{ $item->cantidad }}</span>
                                        <button wire:click="aumentarCantidad({{ $item->id_carrito }}, {{ $item->cantidad }})" class="px-2 py-0.5 text-gray-600 hover:bg-gray-200 font-medium">+</button>
                                    </div>
                                    <p class="text-sm font-bold text-[#274472]">${{ number_format($item->producto->precio * $item->cantidad, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center p-8 text-center">
                    <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p class="text-sm font-semibold text-gray-700">Tu carrito está vacío</p>
                </div>
            @endif
        </div>

        @if(count($items) > 0)
            <div class="border-t border-gray-100 p-4 bg-white z-10 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex justify-between items-center mb-3">
                    <p class="text-sm font-semibold text-gray-500">Total:</p>
                    <p class="text-lg font-black text-[#274472]">${{ number_format($total, 2) }}</p>
                </div>
                
                <button type="button" class="w-full rounded-xl bg-[#274472] px-4 py-2.5 text-sm font-bold text-white shadow-md hover:bg-[#1B3454] transition mb-2">
                    Proceder al pago
                </button>
                
                <div class="text-center">
                    <button wire:click="vaciar" class="text-xs text-gray-400 hover:text-red-500 underline transition">Vaciar carrito</button>
                </div>
            </div>
        @endif
    </div>
</div>