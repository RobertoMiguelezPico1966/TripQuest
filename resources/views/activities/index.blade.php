
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    Actividades de {{ $destination->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $trip->name }}
                </p>
            </div>

            <a href="{{ route('trips.destinations.activities.create', [$trip, $destination]) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Añadir actividad
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

                @if ($activities->isEmpty())
                    <div class="text-center py-10">
                        <div class="text-4xl mb-3">🗓️</div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Todavía no hay actividades
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 mb-5">
                            Añade planes para organizar tu estancia en este destino.
                        </p>
                        <a href="{{ route('trips.destinations.activities.create', [$trip, $destination]) }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Añadir primera actividad
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($activities as $activity)
                            <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-lg flex justify-between items-center flex-wrap gap-4">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                                            {{ $activity->name }}
                                        </h3>
                                        <span class="text-xs px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full">
                                            {{ ucfirst($activity->category) }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                                        {{ $activity->activity_date->format('d/m/Y') }}
                                        @if ($activity->start_time)
                                            · {{ substr($activity->start_time, 0, 5) }}
                                        @endif
                                        @if ($activity->end_time)
                                            - {{ substr($activity->end_time, 0, 5) }}
                                        @endif
                                    </p>

                                    @if ($activity->location)
                                        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                            📍 {{ $activity->location }}
                                        </p>
                                    @endif

                                    @if ($activity->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                            {{ $activity->description }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex gap-3 items-center">
                                    <a href="{{ route('trips.destinations.activities.show', [$trip, $destination, $activity]) }}"
                                       class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-semibold">
                                        Ver
                                    </a>

                                    <a href="{{ route('trips.destinations.activities.edit', [$trip, $destination, $activity]) }}"
                                       class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-semibold">
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
