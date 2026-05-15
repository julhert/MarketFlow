<div class="flex h-screen bg-gray-50 text-gray-900 font-sans">
    
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col py-8 shadow-sm z-10">

        <nav class="w-full px-4 space-y-2">
            <a href="{{ route('admin.panel') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <a href="#" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios
            </a>
            
            <a href="#" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Productos
            </a>
            
            <a href="#" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Ventas
            </a>
            
            <a href="{{ route('categorias') }}" class="flex items-center gap-3 w-full px-4 py-3 bg-[#274472]/10 text-[#274472] font-bold rounded-xl transition">
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
        <div class="flex-1 overflow-y-auto p-10">
            
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
                <h5 class="font-title text-[25px] text-center text-brand-blue-400 uppercase tracking-widest mb-6">
                    Consultar Categorías
                </h5>

                <div class="flex justify-center items-center gap-4 mb-8">
                    <label class="font-body text-brand-blue-300 font-semibold">Nombre</label>

                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="font-body w-[500px] border-2 border-brand-blue-100 rounded-lg px-4 py-2 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Buscar categoría...">

                    <a href=" {{ route('categorias.crear') }} "
                        class="bg-brand-blue-400 text-white px-6 py-2 rounded-lg font-body font-bold hover:bg-brand-blue-300 transition-all active:scale-95 shadow-md flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2001/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Agregar
                    </a>
                </div>

                <div class="mt-4">
                    @if ($datos == null)
                        <div
                            class="font-body text-center py-10 bg-brand-blue-50/20 rounded-xl border-2 border-dashed border-brand-blue-100 text-brand-blue-200">
                            <p class="text-xl">Sin Búsqueda...</p>
                        </div>
                    @else
                        <div class="overflow-hidden rounded-xl shadow-xl border border-brand-blue-100">
                            <table class="w-full text-left bg-white border-collapse">
                                <thead class="bg-brand-blue-400 text-white font-title text-sm uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Nombre</th>
                                        <th class="px-6 py-4">Descripción</th>
                                        <th class="px-6 py-4 text-center">Estado</th>
                                        <th class="px-6 py-4 text-center">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody class="font-body text-[16px] text-main-black divide-y divide-gray-100">
                                    @foreach ($datos as $item)
                                        <tr class="hover:bg-brand-blue-50/30 transition-colors duration-200">
                                            <td class="px-6 py-4 font-semibold text-brand-blue-300">
                                                {{ $item->nombre }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">
                                                {{ $item->descripcion }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if ($item->activo == 'Activo' || $item->activo === 1)
                                                    <span
                                                        class="bg-btn-success/10 text-btn-success px-4 py-1 rounded-full text-xs font-bold uppercase border border-btn-success/20">
                                                        Activo
                                                    </span>
                                                @else
                                                    <span
                                                        class="bg-btn-danger/10 text-btn-danger px-4 py-1 rounded-full text-xs font-bold uppercase border border-btn-danger/20">
                                                        Inactivo
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex justify-center gap-3">
                                                    <a href="{{ route('categorias.modificar', $item->id_categoria) }}" wire:navigate
                                                        class="inline-block p-2 bg-btn-success text-white rounded-lg hover:scale-110 transition-transform shadow-sm focus:outline-none"
                                                        title="Modificar Registro">
                                                        <svg xmlns="http://www.w3.org/2001/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                    </a>

                                                    <button wire:click="eliminar({{ $item->id_categoria }})"
                                                        wire:confirm="Estas seguro que quieres eliminar esta categoria"
                                                        class="p-2 bg-btn-danger text-white rounded-lg hover:scale-110 transition-transform shadow-sm focus:outline-none"
                                                        title="Eliminar Registro">
                                                        <svg xmlns="http://www.w3.org/2001/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </main>
</div>