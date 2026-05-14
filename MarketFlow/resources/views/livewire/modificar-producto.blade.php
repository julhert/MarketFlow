<div x-data="{ isOpen: $wire.entangle('isOpen') }">
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         class="mb-8" 
         style="display: none;" 
         :style="isOpen ? 'display: block !important' : 'display: none !important'">
        
        <div class="bg-white p-8 sm:rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-xl font-bold text-[#274472] mb-6 border-b pb-4">
                Modificar Producto
            </h3>

            <form wire:submit.prevent="actualizar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-12">
                    {{-- Columna Izquierda --}}
                    <div class="space-y-8">
                        <div>
                            <label class="block text-lg font-medium text-gray-800 mb-2">Nombre del producto</label>
                            <input type="text" wire:model="nombre" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4">
                            @error('nombre') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-800 mb-2">Descripción</label>
                            <textarea wire:model="descripcion" rows="4" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4"></textarea>
                            @error('descripcion') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-800 mb-2">Stock unitario</label>
                            <input type="number" wire:model="stock" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4">
                            @error('stock') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Columna Derecha --}}
                    <div class="space-y-8">
                        <div>
                            <label class="block text-lg font-medium text-gray-800 mb-2">Categoría</label>
                            <select wire:model="id_categoria" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4">
                                <option value="">Selecciona una categoría...</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id_categoria }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_categoria') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-800 mb-2">Precio</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><span class="text-gray-500">$</span></div>
                                <input type="number" step="0.01" wire:model="precio" class="w-full pl-8 bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4">
                            </div>
                            @error('precio') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-800 mb-2">Estado del producto</label>
                            <select wire:model="activo" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4">
                                <option value="1">Disponible</option>
                                <option value="0">No disponible</option>
                            </select>
                            @error('activo') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Sección de Imágenes --}}
                <div class="mb-12 border-t border-gray-100 pt-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {{-- Portada Principal --}}
                        <div class="col-span-1">
                            <label class="block text-lg font-medium text-gray-800 mb-4">Portada del producto</label>
                            <div class="w-full aspect-square bg-gray-200 rounded-lg flex items-center justify-center relative hover:bg-gray-300 transition cursor-pointer overflow-hidden">
                                <input type="file" wire:model="portada" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                                
                                {{-- Prioridad: 1. Foto nueva temporal, 2. Foto actual de BD, 3. Placeholder --}}
                                @if ($portada)
                                    <img src="{{ $portada->temporaryUrl() }}" class="w-full h-full object-cover">
                                @elseif ($portada_actual)
                                    <img src="{{ asset('storage/' . $portada_actual) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                        <span class="text-gray-400 font-medium">Añadir portada</span>
                                    </div>
                                @endif
                            </div>
                            @error('portada') <span class="text-sm text-red-500 font-bold mt-2 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Galería Extra --}}
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-lg font-medium text-gray-800 text-center mb-4">Más fotos del producto</label>
                            <div class="flex justify-center gap-4">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="w-28 h-28 bg-gray-200 rounded-lg flex items-center justify-center relative hover:bg-gray-300 transition cursor-pointer overflow-hidden">
                                        <input type="file" wire:model="fotos_extra.{{ $i }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                                        
                                        @if (isset($fotos_extra[$i]) && $fotos_extra[$i])
                                            <img src="{{ $fotos_extra[$i]->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @elseif (isset($fotos_extra_actuales[$i]))
                                            <img src="{{ asset('storage/' . $fotos_extra_actuales[$i]) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400 font-bold text-2xl">+</span>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                            @error('fotos_extra.*') <span class="text-sm text-red-500 font-bold mt-2 block text-center">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Botonera --}}
                <div class="flex justify-center gap-6 pt-4">
                    <button type="button" @click="isOpen = false; $dispatch('cerrar-formulario')" class="w-48 bg-[#2D2D2D] text-white py-3 px-6 rounded-md hover:bg-black transition font-medium tracking-wide text-center">
                        CANCELAR
                    </button>
                    <button type="submit" class="w-48 bg-[#274472] text-white py-3 px-6 rounded-md hover:bg-[#1B3454] transition font-medium tracking-wide flex justify-center items-center">
                        <span wire:loading.remove wire:target="actualizar">ACTUALIZAR</span>
                        <span wire:loading wire:target="actualizar">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            ACTUALIZANDO...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>