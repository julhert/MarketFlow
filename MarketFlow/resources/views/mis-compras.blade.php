<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Mis Compras') }}
            </h2>
            <div class="text-sm text-gray-500">
                Bienvenido de nuevo, {{ explode(' ', Auth::user()->name)[0] }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8">
                
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-gray-800">Historial de Pedidos</h3>
                    <a href="{{ route('catalogo') }}" class="bg-[#5C7AA3] hover:bg-[#274472] text-white px-5 py-2.5 rounded-md text-sm font-semibold transition">
                        Seguir comprando
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pedido</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600">
                            
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="py-4 font-medium text-gray-900">#ORD-00123</td>
                                <td class="py-4">12 May 2026</td>
                                <td class="py-4 font-medium">$1,250.00</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        Entregado
                                    </span>
                                </td>
                                <td class="py-4">
                                    <button class="text-gray-400 hover:text-[#274472] transition flex items-center">
                                        <x-heroicon-o-eye class="w-5 h-5 me-1" />
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="py-4 font-medium text-gray-900">#ORD-00124</td>
                                <td class="py-4">10 May 2026</td>
                                <td class="py-4 font-medium">$450.50</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        En camino
                                    </span>
                                </td>
                                <td class="py-4">
                                    <button class="text-gray-400 hover:text-[#274472] transition flex items-center">
                                        <x-heroicon-o-eye class="w-5 h-5 me-1" />
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between items-center text-sm text-gray-400">
                    <span>Mostrando 1 a 2 de 2 pedidos</span>
                    <div class="flex rounded-md shadow-sm">
                        <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            &laquo;
                        </button>
                        <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-[#1e293b] text-sm font-medium text-white">
                            1
                        </button>
                        <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            &raquo;
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>