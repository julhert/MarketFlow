<div class="max-w-4xl mx-auto mt-16 mb-20 px-4 sm:px-6 lg:px-8">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="border-b border-gray-100 px-6 py-5 bg-gray-50/50">
            <h3 class="text-xl font-black text-[#274472] flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
                Opiniones de la comunidad
            </h3>
        </div>

        <div class="p-6 sm:p-8">

            <div class="mb-10">
                @if ($this->puede_comentar)
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <textarea wire:model="nuevoComentario"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#274472] focus:border-[#274472] text-sm transition-shadow"
                            placeholder="Cuéntanos tu experiencia con este producto..." rows="3"></textarea>

                        @error('nuevoComentario')
                            <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                        @enderror

                        <div class="mt-4 flex justify-end">
                            <button wire:click="enviarComentario"
                                class="bg-[#274472] text-white px-6 py-2.5 rounded-lg font-bold hover:bg-[#1B3454] transition-colors text-sm shadow-sm">
                                Publicar comentario
                            </button>
                        </div>
                    </div>
                @else
                    @auth
                        <div class="flex items-start gap-4 bg-blue-50/80 border border-blue-100 p-5 rounded-xl">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-blue-900 mb-1">Comentarios bloqueados</h4>
                                <p class="text-sm text-blue-700 leading-relaxed">
                                    Para mantener la veracidad de las opiniones, solo los clientes que han adquirido este
                                    producto a través de la plataforma pueden dejar una reseña.
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-200 p-6 rounded-xl text-sm text-gray-600 text-center">
                            Para comentar, primero debes <a href="{{ route('login') }}"
                                class="text-[#274472] font-bold underline hover:text-[#1B3454]">iniciar sesión</a>.
                        </div>
                    @endauth
                @endif
            </div>

            <div class="space-y-6">
                @forelse($comentarios as $item)
                    <div
                        class="flex gap-4 p-5 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ $item->user->profile_photo_url }}"
                            class="w-12 h-12 rounded-full object-cover shadow-sm shrink-0">
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <span class="font-bold text-gray-900 text-sm block">{{ $item->user->name }}</span>
                                    <span
                                        class="text-gray-400 text-xs font-medium">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                                @auth
                                    @if ($item->id_user === auth()->id())
                                        <button wire:click="borrarComentario({{ $item->id_comentario }})"
                                            class="text-gray-300 hover:text-red-500 transition-colors p-1"
                                            title="Eliminar mi comentario">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    @endif
                                @endauth
                            </div>

                            <p class="text-gray-600 text-sm leading-relaxed mt-1">
                                {{ $item->comentario }}
                            </p>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

        </div>
    </div>
</div>
