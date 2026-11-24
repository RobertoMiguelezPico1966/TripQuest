<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    Lugares guardados
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $destination->name }} · {{ $destination->country }}
                </p>
            </div>

            <a href="{{ route('trips.destinations.saved-places.create', [$trip, $destination]) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Añadir lugar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                @if ($places->isEmpty())
                    <div class="text-center py-10">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            Todavía no hay lugares guardados
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-5">
                            Guarda restaurantes, monumentos, tiendas y otros sitios que quieras visitar.
                        </p>

                        <a href="{{ route('trips.destinations.saved-places.create', [$trip, $destination]) }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Añadir primer lugar
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ($places as $place)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5">

                                <div class="flex justify-between items-start gap-3">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-100">
                                            {{ $place->name }}
                                        </h3>

                                        <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-1">
                                            {{ ucfirst($place->category) }}
                                        </p>
                                    </div>

                                    <span class="text-xs font-semibold px-3 py-1 rounded-full
                                        {{ $place->is_visited
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $place->is_visited ? 'Visitado' : 'Pendiente' }}
                                    </span>
                                </div>

                                @if ($place->address)
                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-3">
                                        {{ $place->address }}
                                    </p>
                                @endif

                                @if ($place->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-3">
                                        {{ $place->description }}
                                    </p>
                                @endif

                                <div class="flex flex-wrap gap-3 mt-5">
                                    <a href="{{ route('trips.destinations.saved-places.show', [$trip, $destination, $place]) }}"
                                       class="text-sm text-indigo-600 hover:underline">
                                        Ver detalles
                                    </a>

                                    <a href="{{ route('trips.destinations.saved-places.edit', [$trip, $destination, $place]) }}"
                                       class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                                        Editar
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <div class="mt-6">
                <a href="{{ route('trips.destinations.show', [$trip, $destination]) }}"
                   class="text-gray-600 dark:text-gray-300 hover:underline">
                    ← Volver al destino
                </a>
            </div>

        </div>
    </div>
</x-app-layout>