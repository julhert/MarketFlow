<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- BLOQUE IZQUIERDO: Logo y Enlaces Principales --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    @auth
                        @role('vendedor')
                            <a href="{{ route('dashboard') }}">
                                <span class="text-2xl font-black text-[#274472] tracking-tighter">MarketFlow</span>
                            </a>
                        @endrole
                        @role('comprador')
                            <a href="{{ route('catalogo') }}">
                                <span class="text-2xl font-black text-[#274472] tracking-tighter">MarketFlow</span>
                            </a>
                        @endrole
                    @else
                        <a href="{{ route('catalogo') }}">
                            <span class="text-2xl font-black text-[#274472] tracking-tighter">MarketFlow</span>
                        </a>
                    @endauth
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @role('vendedor')
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Mi Panel') }}
                        </x-nav-link>
                    @endrole

                    @role('comprador')
                        <x-nav-link href="{{ route('mis-compras') }}" :active="request()->routeIs('mis-compras')">
                            {{ __('Mis Compras') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            {{-- BLOQUE DERECHO: Tienda y Perfil de Usuario --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-6">

                @auth
                    @role('comprador')
                        <button @click="$dispatch('abrir-carrito')"
                            class="text-gray-500 hover:text-[#274472] transition relative flex items-center focus:outline-none">
                            <x-heroicon-o-shopping-cart class="w-6 h-6" />
                            <span
                                class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">+</span>
                        </button>
                    @endrole
                @endauth
                <a href="{{ route('catalogo') }}"
                    class="text-sm font-semibold text-gray-500 hover:text-[#274472] transition flex items-center">
                    <x-heroicon-o-building-storefront class="w-5 h-5 me-2" />
                    Ir a la tienda
                </a>

                @auth
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="size-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}
                                            <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Visible para TODOS --}}
            <x-responsive-nav-link href="{{ route('catalogo') }}" :active="request()->routeIs('catalogo')">
                <div class="flex items-center">
                    <x-heroicon-o-building-storefront class="w-5 h-5 me-2" />
                    Catálogo
                </div>
            </x-responsive-nav-link>

            {{-- Visible SOLO logueados --}}
            @auth
                @role('vendedor')
                    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <div class="flex items-center">
                            <x-heroicon-o-chart-pie class="w-5 h-5 me-2" />
                            Mi Panel
                        </div>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="#" :active="false">
                        <div class="flex items-center">
                            <x-heroicon-o-pencil-square class="w-5 h-5 me-2" />
                            Mis Productos
                        </div>
                    </x-responsive-nav-link>
                @endrole

                @role('comprador')
                    <button @click="$dispatch('abrir-carrito'); open = false" class="w-full text-left">
                        <x-responsive-nav-link href="#" :active="false">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center">
                                    <x-heroicon-o-shopping-cart class="w-5 h-5 me-2" />
                                    Mi Carrito
                                </div>
                                <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">+</span>
                            </div>
                        </x-responsive-nav-link>
                    </button>
                    <x-responsive-nav-link href="#" :active="false">
                        <div class="flex items-center">
                            <x-heroicon-o-shopping-bag class="w-5 h-5 me-2" />
                            Mis Compras
                        </div>
                    </x-responsive-nav-link>
                @endrole
            @endauth

            {{-- Visible SOLO Visitantes --}}
            @guest
                <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    <div class="flex items-center text-[#5C7AA3]">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 me-2" />
                        Iniciar Sesión
                    </div>
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    <div class="flex items-center text-[#274472] font-bold">
                        <x-heroicon-o-user-plus class="w-5 h-5 me-2" />
                        Registrarse
                    </div>
                </x-responsive-nav-link>
            @endguest
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        Perfil
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            API Tokens
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            Cerrar Sesión
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
