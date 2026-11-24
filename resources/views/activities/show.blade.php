
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    {{ $activity->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $destination->name }} · {{ $trip->name }}
                </p>
            </div>

            <a href="{{ route('trips.destinations.activities.edit', [$trip, $destination, $activity]) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Editar actividad
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <div class="mb-6">
                    <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                        {{ ucfirst($activity->category) }}
                    </span>
                </div>

                <div class="space-y-5">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Fecha</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ $activity->activity_date->format('d/m/Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Horario</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ $activity->start_time ? substr($activity->start_time, 0, 5) : 'Sin hora de inicio' }}
                            —
                            {{ $activity->end_time ? substr($activity->end_time, 0, 5) : 'Sin hora de finalización' }}
                        </p>
                    </div>

                    @if ($activity->location)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ubicación</p>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">
                                {{ $activity->location }}
                            </p>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Descripción</p>
                        <p class="text-gray-800 dark:text-gray-100">
                            {{ $activity->description ?: 'Sin descripción.' }}
                        </p>
                    </div>

                </div>

                <div class="flex justify-between items-center flex-wrap gap-4 mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('trips.destinations.activities.index', [$trip, $destination]) }}"
                       class="text-gray-600 dark:text-gray-300 hover:underline">
                        ← Volver a actividades
                    </a>

                    <form method="POST"
                          action="{{ route('trips.destinations.activities.destroy', [$trip, $destination, $activity]) }}"
                          onsubmit="return confirm('¿Seguro que quieres eliminar esta actividad?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold">
                            Eliminar actividad
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
