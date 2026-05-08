<x-guest-layout>
    
    {{-- 1. PANTALLA DE SELECCIÓN --}}
    @if(!request()->has('tipo'))
        <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-8">
                <span class="text-3xl font-black text-[#274472] tracking-tighter">MarketFlow</span>
                <h2 class="mt-6 text-2xl font-extrabold text-gray-900">¿Cómo quieres unirte a nosotros?</h2>
                <p class="mt-2 text-sm text-gray-600">Selecciona tu perfil para continuar con el registro</p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-4xl px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <a href="{{ route('register', ['tipo' => 'comprador']) }}" class="bg-white p-10 rounded-2xl shadow-sm border-2 border-transparent hover:border-[#274472] hover:shadow-xl transition-all duration-300 group text-center flex flex-col items-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-[#EDE8F5] transition">
                            <x-heroicon-o-shopping-bag class="w-10 h-10 text-gray-600 group-hover:text-[#274472]" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Quiero Comprar</h3>
                        <p class="text-gray-500 text-sm">Busca las mejores ofertas y productos de tecnología en nuestro catálogo.</p>
                    </a>

                    <a href="{{ route('register', ['tipo' => 'vendedor']) }}" class="bg-white p-10 rounded-2xl shadow-sm border-2 border-transparent hover:border-[#274472] hover:shadow-xl transition-all duration-300 group text-center flex flex-col items-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-[#EDE8F5] transition">
                            <x-heroicon-o-building-storefront class="w-10 h-10 text-gray-600 group-hover:text-[#274472]" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Quiero Vender</h3>
                        <p class="text-gray-500 text-sm">Publica tus productos, gestiona tu inventario y llega a miles de clientes.</p>
                    </a>
                </div>

                <div class="mt-10 text-center text-sm text-gray-500">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="font-bold text-[#274472] hover:underline">Inicia sesión aquí</a>
                </div>
            </div>
        </div>

    {{-- 2. PANTALLA DEL FORMULARIO --}}
    @else
        <x-authentication-card>
            <x-slot name="logo">
                <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-8">
                <span class="text-3xl font-black text-[#274472] tracking-tighter">MarketFlow</span>
                </div>
            </x-slot>

            <x-validation-errors class="mb-4" />

            <div class="mb-6 p-4 bg-blue-50 rounded-lg text-center border border-blue-100">
                <span class="text-sm text-blue-800">Registrándote como: <b class="uppercase">{{ request()->tipo }}</b></span>
                <br>
                <a href="{{ route('register') }}" class="text-xs text-blue-600 hover:text-blue-800 underline mt-1 inline-block">Cambiar rol</a>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <input type="hidden" name="tipo_usuario" value="{{ request()->tipo }}">

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#274472]">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#274472]">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-6">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#274472]" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="ms-4 bg-[#274472] text-white px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-[#1B3454] transition">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </x-authentication-card>
    @endif
</x-guest-layout>