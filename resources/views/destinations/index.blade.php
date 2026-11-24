<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('trips.show', $trip) }}"
                   class="text-sm text-indigo-600 hover:underline mb-2 inline-block">
                    ← Volver al viaje
                </a>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Destinos de {{ $trip->name }}
                </h2>
            </div>

            <a href="{{ route('trips.destinations.create', $trip) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                + Añadir destino
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

            @if ($destinations->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-10 text-center">
                    <div class="text-5xl mb-4">📍</div>

                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                        Todavía no hay destinos
                    </h3>

                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        Añade las ciudades o lugares que visitarás durante este viaje.
                    </p>

                    <a href="{{ route('trips.destinations.create', $trip) }}"
                       class="inline-block px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                        Añadir primer destino
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($destinations as $destination)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                            <div class="text-4xl mb-4">📍</div>

                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-1">
                                {{ $destination->name }}
                            </h3>

                            <p class="text-indigo-600 dark:text-indigo-400 text-sm font-medium mb-4">
                                {{ $destination->country }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                {{ $destination->arrival_date->format('d/m/Y') }}
                                —
                                {{ $destination->departure_date->format('d/m/Y') }}
                            </p>

                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-5">
                                {{ $destination->description ?: 'Sin descripción.' }}
                            </p>

                            <div class="flex gap-3">
                                <a href="{{ route('trips.destinations.show', [$trip, $destination]) }}"
                                   class="flex-1 text-center py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold text-sm">
                                    Ver destino
                                </a>

                                <a href="{{ route('trips.destinations.edit', [$trip, $destination]) }}"
                                   class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Editar
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>