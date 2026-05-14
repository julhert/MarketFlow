<div>
@if($isOpen)
<div class="mb-8 transition-all duration-300 ease-in-out">
    <div class="bg-white p-8 sm:rounded-xl shadow-sm border border-gray-200">
        
        <h3 class="text-xl font-bold text-[#274472] mb-6 border-b pb-4">
            Agregar Nuevo Producto
        </h3>

        <form wire:submit.prevent="guardar">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-12">
                <div class="space-y-8">
                    <div>
                        <label class="block text-lg font-medium text-gray-800 mb-2">Nombre del producto</label>
                        <input type="text" wire:model="nombre" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4" placeholder="Ej. Taladro Inalámbrico">
                        @error('nombre') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-lg font-medium text-gray-800 mb-2">Descripción</label>
                        <textarea wire:model="descripcion" rows="4" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4" placeholder="Detalles del producto..."></textarea>
                        @error('descripcion') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-lg font-medium text-gray-800 mb-2">Stock unitario</label>
                        <input type="number" wire:model="stock" class="w-full bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4" placeholder="0">
                        @error('stock') <span class="text-sm text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

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
                            <input type="number" step="0.01" wire:model="precio" class="w-full pl-8 bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent py-3 px-4" placeholder="0.00">
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

            <div class="mb-12 border-t border-gray-100 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="col-span-1">
                        <label class="block text-lg font-medium text-gray-800 mb-4">Portada del producto</label>
                        <div class="w-full aspect-square bg-gray-200 rounded-lg flex items-center justify-center relative hover:bg-gray-300 transition cursor-pointer overflow-hidden">
                            <input type="file" wire:model="portada" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                            @if ($portada && !is_string($portada))
                                <img src="{{ $portada->temporaryUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 font-medium">+ Añadir portada</span>
                            @endif
                        </div>
                        @error('portada') <span class="text-sm text-red-500 font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-lg font-medium text-gray-800 text-center mb-4">Más fotos del producto</label>
                        <div class="flex justify-center gap-4">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="w-28 h-28 bg-gray-200 rounded-lg flex items-center justify-center relative hover:bg-gray-300 transition cursor-pointer overflow-hidden">
                                    <input type="file" wire:model="fotos_extra.{{ $i }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                                    @if (isset($fotos_extra[$i]) && !is_string($fotos_extra[$i]))
                                        <img src="{{ $fotos_extra[$i]->temporaryUrl() }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-400 font-bold text-2xl">+</span>
                                    @endif
                                </div>
                            @endfor
                        </div>
                        @error('fotos_extra.*') <span class="text-sm text-red-500 font-bold mt-2 block text-center">{{ $message }}</span> @enderror
                        @error('fotos_extra') <span class="text-sm text-red-500 font-bold mt-2 block text-center">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-6 pt-4">
                <button type="button" @click="$dispatch('cerrar-formulario')" class="w-48 bg-[#2D2D2D] text-white py-3 px-6 rounded-md hover:bg-black transition font-medium tracking-wide text-center">
                    CANCELAR
                </button>
                <button type="submit" class="w-48 bg-[#274472] text-white py-3 px-6 rounded-md hover:bg-[#1B3454] transition font-medium tracking-wide flex justify-center items-center">
                    <span wire:loading.remove wire:target="guardar">GUARDAR</span>
                    <span wire:loading wire:target="guardar">GUARDANDO...</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endif
</div>