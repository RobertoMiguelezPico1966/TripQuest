
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    {{ $destination->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $destination->country }}
                </p>
            </div>

            <a href="{{ route('trips.destinations.edit', [$trip, $destination]) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Editar destino
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

            <!-- Información del destino -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Información del destino
                </h3>

                @if ($destination->description)
                    <p class="text-gray-600 dark:text-gray-300 mb-5">
                        {{ $destination->description }}
                    </p>
                @else
                    <p class="text-gray-500 dark:text-gray-400 mb-5">
                        No hay descripción para este destino.
                    </p>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Llegada
                        </p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $destination->arrival_date->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Salida
                        </p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $destination->departure_date->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actividades -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">
                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Actividades
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Planifica qué hacer durante tu estancia.
                        </p>
                    </div>

                    <a href="{{ route('trips.destinations.activities.index', [$trip, $destination]) }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                        Gestionar actividades
                    </a>
                </div>

                @php
                    $activities = $destination->activities()
                        ->orderBy('activity_date')
                        ->orderBy('start_time')
                        ->take(5)
                        ->get();
                @endphp

                @if ($activities->isEmpty())
                    <p class="text-center text-gray-500 dark:text-gray-400 py-6">
                        Todavía no has añadido actividades.
                    </p>
                @else
                    <div class="space-y-3">
                        @foreach ($activities as $activity)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex justify-between items-start gap-3 flex-wrap">
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                                            {{ $activity->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                            {{ $activity->activity_date->format('d/m/Y') }}
                                            @if ($activity->start_time)
                                                · {{ \Illuminate\Support\Str::substr($activity->start_time, 0, 5) }}
                                            @endif
                                        </p>
                                    </div>

                                    <span class="text-xs font-semibold px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full">
                                        {{ ucfirst($activity->category) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Lugares guardados -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">
                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Lugares guardados
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Guarda los sitios que quieres descubrir.
                        </p>
                    </div>

                    <a href="{{ route('trips.destinations.saved-places.index', [$trip, $destination]) }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                        Gestionar lugares
                    </a>
                </div>

                @php
                    $places = $destination->savedPlaces()
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                @if ($places->isEmpty())
                    <p class="text-center text-gray-500 dark:text-gray-400 py-6">
                        Todavía no has guardado ningún lugar.
                    </p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($places as $place)
                            <a href="{{ route('trips.destinations.saved-places.show', [$trip, $destination, $place]) }}"
                               class="block p-5 bg-gray-50 dark:bg-gray-700 rounded-lg hover:shadow-md transition">

                                <div class="flex justify-between items-start gap-3">
                                    <h4 class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $place->name }}
                                    </h4>

                                    <span class="text-xs font-semibold px-3 py-1 rounded-full
                                        {{ $place->is_visited
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $place->is_visited ? 'Visitado' : 'Pendiente' }}
                                    </span>
                                </div>

                                <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-2">
                                    {{ ucfirst($place->category) }}
                                </p>

                                @if ($place->address)
                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                                        {{ $place->address }}
                                    </p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('trips.show', $trip) }}"
                   class="text-gray-600 dark:text-gray-300 hover:underline">
                    ← Volver al viaje
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
