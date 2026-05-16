<div class="flex h-screen bg-gray-50 text-gray-900 font-sans">
    
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col py-8 shadow-sm z-10">

        <nav class="w-full px-4 space-y-2">
            <a href="{{ route('admin.panel') }}" class="flex items-center gap-3 w-full px-4 py-3 bg-[#274472]/10 text-[#274472] font-bold rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.usuarios') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios
            </a>
            <a href="{{ route('admin.productos') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Productos
            </a>
            <a href="{{ route('admin.ventas') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Ventas
            </a>
            <a href="{{ route('categorias') }}" class="flex items-center gap-3 w-full px-4 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#274472] transition">
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
            
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-800">Resumen General</h2>
                <p class="text-gray-500 text-sm mt-1">Estadísticas actualizadas de MarketFlow</p>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition duration-300">
                        <svg class="w-24 h-24 text-[#274472]" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                    </div>
                    <div class="flex flex-col relative z-10">
                        <h3 class="text-base font-bold text-gray-500 mb-2">Total de usuarios</h3>
                        <p class="text-5xl font-black text-[#274472]">{{ $totalUsuarios }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition duration-300">
                        <svg class="w-24 h-24 text-[#274472]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="flex flex-col relative z-10">
                        <h3 class="text-base font-bold text-gray-500 mb-2">Total de vendedores</h3>
                        <p class="text-5xl font-black text-[#274472]">{{ $totalVendedores }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="flex flex-col relative z-10">
                        <h3 class="text-base font-bold text-gray-500 mb-2">Total de clientes</h3>
                        <p class="text-5xl font-black text-[#274472]">{{ $totalClientes }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="flex flex-col relative z-10">
                        <h3 class="text-base font-bold text-gray-500 mb-2">Total de pedidos</h3>
                        <p class="text-5xl font-black text-[#274472]">{{ $totalPedidos }}</p>
                    </div>
                </div>

            </div>

            <div class="bg-gradient-to-r from-[#274472] to-[#1B3454] rounded-3xl p-10 flex items-center justify-between shadow-lg relative overflow-hidden group hover:shadow-xl transition duration-300">
                <div class="absolute -right-10 -top-24 w-64 h-64 rounded-full border-4 border-white/10 opacity-50"></div>
                <div class="absolute right-20 -bottom-20 w-40 h-40 rounded-full border-4 border-white/10 opacity-50"></div>
                
                <div class="relative z-10">
                    <h3 class="text-lg font-bold text-blue-100 mb-1">Inventario Global</h3>
                    <h2 class="text-3xl font-black text-white">Total de productos</h2>
                </div>
                <div class="relative z-10 bg-white/10 backdrop-blur-sm rounded-2xl px-8 py-4 border border-white/20">
                    <p class="text-6xl font-black text-white">{{ $totalProductos }}</p>
                </div>
            </div>

        </div>
    </main>
</div>