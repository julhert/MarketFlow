<div class="min-h-screen bg-gray-50">

    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-black text-[#274472] tracking-tighter">MarketFlow</span>
                </div>

                <div class="flex-1 max-w-2xl mx-8 hidden md:block">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="h-5 w-5 text-gray-400" />
                        </div>
                        <input wire:model.live.debounce.500ms="busqueda" type="text"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-full leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#274472] focus:border-transparent transition"
                            placeholder="Buscar herramientas, materiales, electrónica...">
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="#"
                            class="text-gray-500 hover:text-[#274472] transition relative flex items-center mt-1">
                            <x-heroicon-o-shopping-cart class="h-6 w-6" />
                            <span
                                class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
                        </a>

                        @role('vendedor')
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-[#274472] transition ml-6 hidden sm:block">
                                Mi Panel
                            </a>
                        @endrole

                        @role('comprador')
                            <a href="{{ route('mis-compras') }}" class="text-sm font-semibold text-gray-700 hover:text-[#274472] transition ml-6 hidden sm:block">
                                Mis Compras
                            </a>
                        @endrole

                        <div class="ms-4 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}"
                                                alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}
                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Administrar Cuenta
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        Perfil
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            API Tokens
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            Cerrar Sesión
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-[#274472] transition">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}"
                            class="ml-4 bg-[#274472] text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-[#1B3454] shadow-sm transition">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-8 h-12 overflow-x-auto text-sm font-medium text-gray-600">

                <button wire:click="seleccionarCategoria(null)"
                    class="whitespace-nowrap h-full flex items-center border-b-2 transition-colors {{ is_null($categoria_seleccionada) ? 'border-[#274472] text-[#274472]' : 'border-transparent hover:text-gray-900 hover:border-gray-300' }}">
                    Todas las categorías
                </button>

                @foreach ($categorias as $cat)
                    <button wire:click="seleccionarCategoria({{ $cat->id_categoria }})"
                        class="whitespace-nowrap h-full flex items-center border-b-2 transition-colors {{ $categoria_seleccionada == $cat->id_categoria ? 'border-[#274472] text-[#274472]' : 'border-transparent hover:text-gray-900 hover:border-gray-300' }}">
                        {{ $cat->nombre }}
                    </button>
                @endforeach

            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- <div class="w-full h-48 md:h-64 bg-gradient-to-r from-[#274472] to-[#1B3454] rounded-2xl flex flex-col items-center justify-center mb-10 shadow-md relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="relative z-10 text-center px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">
                    @if ($categoria_seleccionada)
                        {{ collect($categorias)->firstWhere('id_categoria', $categoria_seleccionada)->nombre ?? 'Categoría' }}
                    @else
                        Todo nuestro catálogo
                    @endif
                </h2>
                <p class="text-gray-200 text-sm md:text-base">Encuentra los mejores productos al mejor precio.</p>
            </div>
        </div> --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($productos as $producto)
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300 group flex flex-col">

                    <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($producto->nombre) }}&background=random&color=fff&size=512"
                            alt="{{ $producto->nombre }}"
                            class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold text-gray-800 leading-tight mb-1 line-clamp-2">
                            {{ $producto->nombre }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                            {{ $producto->descripcion ?? 'Sin descripción detallada.' }}
                        </p>

                        <div class="mt-auto">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="text-2xl font-bold text-gray-900">${{ number_format($producto->precio, 2) }}</span>
                                <span
                                    class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full border border-green-100">
                                    En stock
                                </span>
                            </div>

                            <button
                                class="w-full bg-white border-2 border-[#274472] text-[#274472] py-2.5 rounded-xl font-bold hover:bg-[#274472] hover:text-white transition-colors duration-200">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <x-heroicon-o-archive-box class="mx-auto h-12 w-12 text-gray-300 mb-4" />
                    <h3 class="text-lg font-medium text-gray-900">No se encontraron productos</h3>
                    <p class="mt-1 text-gray-500">Intenta buscar con otros términos o selecciona otra categoría.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $productos->links() }}
        </div>

    </main>
</div>
