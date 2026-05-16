<div class="flex h-screen bg-gray-50 text-gray-900 font-sans">
    
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col py-8 shadow-sm z-10 shrink-0">
        <nav class="w-full px-4 space-y-2">
            <a href="{{ route('admin.panel') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.usuarios') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios
            </a>
            <a href="{{ route('admin.productos') }}" class="flex items-center gap-3 w-full px-4 py-3 bg-[#274472]/10 text-[#274472] font-bold rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Productos
            </a>
            <a href="{{ route('admin.ventas') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Ventas
            </a>
            <a href="{{ route('categorias') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Categorias
            </a>
        </nav>

        <div class="mt-auto w-full px-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-3 text-gray-500 font-semibold rounded-xl hover:bg-red-50 hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden bg-[#F4F6F9]">
        <div class="flex-1 overflow-y-auto p-10">
            
            <h5 class="font-title text-[25px] text-center text-brand-blue-400 uppercase tracking-widest mb-8">
                Registrar Nuevo Producto
            </h5>

            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl border border-brand-blue-100 overflow-hidden">
                <div class="bg-brand-blue-400 py-3 px-6">
                    <p class="text-white font-title text-xs uppercase tracking-widest">Información del Producto</p>
                </div>

                <form wire:submit.prevent="Guardar" class="p-8">
                    <div class="grid grid-cols-2 gap-8">
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block font-body text-brand-blue-300 font-bold mb-1">Nombre del Producto</label>
                                <input type="text" wire:model="nombre" class="w-full border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 text-main-black transition-all">
                                @error('nombre') <span class="text-btn-danger text-xs italic">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block font-body text-brand-blue-300 font-bold mb-1">Categoría</label>
                                <select wire:model="id_categoria" class="w-full border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 text-main-black bg-white">
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat->id_categoria }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('id_categoria') <span class="text-btn-danger text-xs italic">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-body text-brand-blue-300 font-bold mb-1">Precio ($)</label>
                                    <input type="number" step="0.01" wire:model="precio" class="w-full border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 text-main-black">
                                    @error('precio') <span class="text-btn-danger text-xs italic">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-body text-brand-blue-300 font-bold mb-1">Stock Inicial</label>
                                    <input type="number" wire:model="stock" class="w-full border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 text-main-black">
                                    @error('stock') <span class="text-btn-danger text-xs italic">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block font-body text-brand-blue-300 font-bold mb-1">Descripción</label>
                                <textarea wire:model="descripcion" rows="3" class="w-full border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 text-main-black"></textarea>
                                @error('descripcion') <span class="text-btn-danger text-xs italic">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center border-2 border-dashed border-brand-blue-100 rounded-2xl p-4 bg-gray-50">
                            <label class="font-body text-brand-blue-300 font-bold mb-4">Imagen del Producto</label>
                            
                            @if ($imagen)
                                <img src="{{ $imagen->temporaryUrl() }}" class="w-48 h-48 object-cover rounded-xl shadow-md mb-4">
                            @else
                                <div class="w-48 h-48 bg-gray-200 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif

                            <input type="file" wire:model="imagen" id="upload" class="hidden">
                            <label for="upload" class="cursor-pointer bg-brand-blue-100 text-[#274472] px-4 py-2 rounded-lg font-bold hover:bg-brand-blue-200 transition-all">
                                Seleccionar archivo
                            </label>
                            @error('imagen') <span class="text-btn-danger text-xs italic mt-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                        <button type="button" wire:click="Cancelar" class="bg-btn-danger text-white px-6 py-2 rounded-lg font-body font-bold hover:opacity-90 shadow-md">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-btn-success text-white px-10 py-2 rounded-lg font-body font-bold hover:opacity-90 shadow-md flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>