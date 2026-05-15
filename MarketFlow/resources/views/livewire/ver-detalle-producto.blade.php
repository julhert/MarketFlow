<div class="max-w-5xl mx-auto mt-10 bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">

    <!-- Alertas -->
    @if (session()->has('mensaje'))
        <div class="p-4 text-sm text-green-700 bg-green-50 border-b border-green-200">
            <span class="font-bold">¡Éxito!</span> {{ session('mensaje') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 text-sm text-red-700 bg-red-50 border-b border-red-200">
            <span class="font-bold">Aviso:</span> {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

        <!-- COLUMNA IZQUIERDA: IMAGEN -->
        <!-- Le pusimos un borde sutil a la derecha para separar como en tu otra vista -->

        <div
            class="p-8 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col items-center bg-white min-h-[400px]">

            @if ($producto->imagenes && $producto->imagenes->count() > 0)

                <!-- Llamamos a ->url directamente en la primera imagen -->
                <div x-data="{ imagenActiva: '{{ $producto->imagenes->first()->url }}' }" class="w-full flex flex-col gap-4">

                    <div class="w-full h-[400px] flex justify-center items-center bg-white">
                        <img x-bind:src="imagenActiva" alt="{{ $producto->nombre }}"
                            class="max-w-full max-h-full object-contain transition-all duration-300">
                    </div>

                    @if ($producto->imagenes->count() > 1)
                        <div class="flex gap-3 overflow-x-auto py-2 justify-center">
                            @foreach ($producto->imagenes as $imagen)
                                <button type="button" @click="imagenActiva = '{{ $imagen->url }}'"
                                    class="shrink-0 rounded-sm border-2 overflow-hidden transition-all"
                                    x-bind:class="imagenActiva === '{{ $imagen->url }}' ? 'border-blue-500 opacity-100' :
                                        'border-gray-200 opacity-60 hover:opacity-100'">
                                    <img src="{{ $imagen->url }}" alt="Miniatura"
                                        class="w-16 h-16 object-cover bg-gray-50">
                                </button>
                            @endforeach
                        </div>
                    @endif

                </div>
            @else
                <!-- Placeholder SVG -->
                <div
                    class="w-full h-full flex flex-col items-center justify-center rounded-sm border border-dashed border-gray-300">
                    <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="text-gray-400 font-medium text-sm">Fotografía no disponible</span>
                </div>
            @endif

        </div>

        <!-- COLUMNA DERECHA: DETALLES Y COMPRA -->
        <div class="p-8 md:p-12 flex flex-col justify-center bg-white">

            <!-- Etiqueta superior minimalista -->
            <div class="mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">
                Stock disponible: {{ $producto->stock }}
            </div>

            <!-- Título limpio -->
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $producto->nombre }}</h1>

            <!-- Precio destacado sin ser exagerado -->
            <p class="text-3xl font-light text-gray-800 mb-6">${{ number_format($producto->precio, 2) }}</p>

            <!-- Descripción -->
            <div class="text-sm text-gray-600 mb-8 leading-relaxed whitespace-pre-line border-t border-gray-100 pt-6">
                {{ $producto->descripcion }}
            </div>
            <!-- CAJA DE CONTROLES -->
            <div class="bg-gray-50 border border-gray-100 p-6 rounded-sm mt-8">

                @auth
                    @role('comprador')
                        <label for="cantidad" class="block text-sm font-semibold text-gray-700 mb-3">
                            ¿Cuántas unidades deseas llevar?
                        </label>
                    @endrole
                @endauth

                <div class="flex flex-col sm:flex-row items-start gap-4">

                    @auth
                        @role('comprador')
                            <div class="relative w-full sm:w-1/3">
                                <input type="number" id="cantidad" wire:model="cantidad" min="1"
                                    max="{{ $producto->stock }}"
                                    class="w-full pl-4 pr-12 py-3 text-center border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 text-sm font-bold text-gray-800 shadow-sm bg-white">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                </div>
                            </div>
                        @endrole
                    @endauth

                    <div class="w-full @auth @role('comprador') sm:w-2/3 @endrole @endauth flex flex-col gap-3">

                        @auth
                            @role('comprador')
                                <button wire:click="agregar"
                                    class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 font-medium py-3 px-4 rounded-sm transition-colors text-sm tracking-wide shadow-sm flex justify-center items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    Agregar al carrito
                                </button>
                            @endrole

                            @role('vendedor')
                                <button disabled
                                    class="w-full bg-gray-100 text-gray-400 font-medium py-3 px-4 rounded-sm border border-gray-200 cursor-not-allowed flex justify-center items-center gap-2"
                                    title="Los vendedores no pueden realizar compras">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    Modo Vendedor (Compras deshabilitadas)
                                </button>
                            @endrole
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-medium py-3 px-4 rounded-sm transition-colors text-sm tracking-wide text-center block">
                                Inicia sesión para comprar
                            </a>
                        @endauth

                    </div>

                </div>
            </div>
        </div>
    </div> <livewire:carrito-compras />
    <livewire:comentarios-producto :idProducto="$producto->id_producto" />
</div>
