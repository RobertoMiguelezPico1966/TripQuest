
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    {{ $savedPlace->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $destination->name }} · {{ $destination->country }}
                </p>
            </div>

            <a href="{{ route('trips.destinations.saved-places.edit', [$trip, $destination, $savedPlace]) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Editar lugar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <div class="flex justify-between items-center mb-6">
                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ ucfirst($savedPlace->category) }}
                    </span>

                    <span class="text-xs font-semibold px-3 py-1 rounded-full
                        {{ $savedPlace->is_visited
                            ? 'bg-green-100 text-green-700'
                            : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $savedPlace->is_visited ? 'Visitado' : 'Pendiente de visitar' }}
                    </span>
                </div>

                @if ($savedPlace->description)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            Descripción
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ $savedPlace->description }}
                        </p>
                    </div>
                @endif

                @if ($savedPlace->address)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            Dirección
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ $savedPlace->address }}
                        </p>
                    </div>
                @endif

                @if ($savedPlace->website)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            Página web
                        </h3>
                        <a href="{{ $savedPlace->website }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-indigo-600 dark:text-indigo-400 hover:underline break-all">
                            {{ $savedPlace->website }}
                        </a>
                    </div>
                @endif

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                    <form method="POST"
                          action="{{ route('trips.destinations.saved-places.update', [$trip, $destination, $savedPlace]) }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="name" value="{{ $savedPlace->name }}">
                        <input type="hidden" name="description" value="{{ $savedPlace->description }}">
                        <input type="hidden" name="address" value="{{ $savedPlace->address }}">
                        <input type="hidden" name="website" value="{{ $savedPlace->website }}">
                        <input type="hidden" name="category" value="{{ $savedPlace->category }}">
                        <input type="hidden" name="is_visited" value="{{ $savedPlace->is_visited ? 0 : 1 }}">

                        <button type="submit"
                                class="w-full px-5 py-3 {{ $savedPlace->is_visited ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg font-semibold">
                            {{ $savedPlace->is_visited ? 'Marcar como pendiente' : 'Marcar como visitado' }}
                        </button>
                    </form>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('trips.destinations.saved-places.index', [$trip, $destination]) }}"
                       class="text-gray-600 dark:text-gray-300 hover:underline">
                        ← Volver a lugares
                    </a>

                    <form method="POST"
                          action="{{ route('trips.destinations.saved-places.destroy', [$trip, $destination, $savedPlace]) }}"
                          onsubmit="return confirm('¿Seguro que quieres eliminar este lugar?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="text-red-600 hover:text-red-800 font-semibold">
                            Eliminar lugar
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
