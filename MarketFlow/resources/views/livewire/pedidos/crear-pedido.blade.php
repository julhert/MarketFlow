<div>
    <div class="min-h-screen bg-gray-100 p-6 md:p-12 font-['Inter']">
        <div class="max-w-[1400px] mx-auto">
            <header class="mb-10">
                <h1 class="text-4xl font-extrabold text-main-dark" style="font-family: 'Julius Sans One', sans-serif;">
                    Tu Pedido
                </h1>
            </header>

            <div class="flex flex-col lg:flex-row gap-12 items-start">
                <div class="w-full lg:w-[65%] bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden"
                    style="font-family: 'Julius Sans One', sans-serif;">
                    <div class="p-8 md:p-5 space-y-8">
                        @foreach ($itemsCarrito as $item)
                            <div class="flex items-center justify-between border-b pb-4 mb-4">
                                <div class="flex items-center gap-4">
                                    {{-- Usamos la relación para sacar la imagen --}}
                                    <img src="{{ asset('storage/' . $item->producto->imagenes->first()->rutaImagen) }}"
                                        alt="Imagen" class="w-16 h-16 object-cover rounded shadow">

                                    <div>
                                        {{-- OJO: Aquí usamos $item->producto->nombre --}}
                                        <h4 class="font-bold text-gray-800">{{ $item->producto->nombre }}</h4>
                                        <p class="text-sm text-gray-500">Cantidad: {{ $item->cantidad }}</p>
                                    </div>
                                </div>

                                {{-- Calculamos el subtotal por producto --}}
                                <span class="font-bold text-gray-900">
                                    ${{ number_format($item->producto->precio * $item->cantidad, 2) }}
                                </span>
                            </div>
                        @endforeach

                        {{-- Fuera del loop, muestras el total que ya calculaste en el mount --}}
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-lg font-bold text-gray-700">Total a pagar:</span>
                            <span
                                class="text-2xl font-black text-orange-600">${{ number_format($totalCompra, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-[35%] space-y-6">
                    <div class="bg-main-dark rounded-4xl p-10 shadow-2xl text-black border border-white/5"
                        style="font-family: 'Julius Sans One', sans-serif;">
                        <h3 class="text-xl font-bold mb-8 border-b border-white/10 pb-4">Checkout</h3>

                        <div class="space-y-8">
                            <div class="space-y-3">
                                <label
                                    class="text-[11px] font-black text-black/70 uppercase tracking-widest ml-1">Dirección
                                    de Envío</label>
                                <div class="relative">
                                    <select wire:model.live="id_direccion" id="id_direccion_select"
                                        class="w-full bg-white/10 border border-white/20 rounded-2xl py-4 px-5 font-ligth text-sm text-black appearance-none outline-none focus:ring-2 focus:ring-btn-buy transition-all cursor-pointer">
                                        <option value="" class="text-black">Selecciona tu dirección...</option>
                                        @foreach ($direcciones as $dir)
                                            <option value="{{ $dir->id_direccion }}">{{ $dir->calle }}
                                                {{ $dir->numero_exterior }} {{ $dir->colonia }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label
                                    class="text-[11px] font-black text-black/70 uppercase tracking-widest ml-1">Método
                                    de Pago</label>
                                <div class="grid gap-3">
                                    <label for="pago_debito"
                                        class="flex items-center justify-between p-4 bg-gray-50 border-2 border-white/10 rounded-2xl cursor-pointer">
                                        <div class="flex items-center gap-4">
                                            <input type="radio" id="pago_debito" wire:model="metodoPago"
                                                value="Tarjeta de Débito" name="pago" class="w-5 h-5 text-btn-buy">
                                            <span class="text-sm font-bold">Tarjeta de Débito</span>
                                        </div>
                                    </label>

                                    <label for="pago_paypal"
                                        class="flex items-center justify-between p-4 bg-gray-50 border-2 border-white/10 rounded-2xl cursor-pointer">
                                        <div class="flex items-center gap-4">
                                            <input type="radio" id="pago_paypal" wire:model="metodoPago"
                                                value="PayPal" name="pago" class="w-5 h-5 text-btn-buy">
                                            <span class="text-sm font-bold">PayPal</span>
                                        </div>
                                    </label>

                                    <label for="pago_credito"
                                        class="flex items-center justify-between p-4 bg-gray-50 border-2 border-white/10 rounded-2xl cursor-pointer">
                                        <div class="flex items-center gap-4">
                                            <input type="radio" id="pago_credito" wire:model="metodoPago"
                                                value="Tarjeta de Crédito" name="pago" class="w-5 h-5 text-btn-buy">
                                            <span class="text-sm font-bold">Tarjeta de Crédito</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button wire:click="confirmarCompra" wire:loading.attr="disabled"
                                    class="w-full bg-btn-buy text-main-dark font-black py-6 rounded-2xl transition-all shadow-xl shadow-btn-buy/20 active:scale-95 text-base uppercase tracking-widest">
                                    <span wire:loading.remove>Confirmar Pedido</span>
                                    <span wire:loading>Procesando...</span>
                                </button>
                                @if ($errors->any())
                                    <div class="text-red-500 text-sm mt-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
