
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">
                    Mi panel de viajes
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Bienvenido a TripQuest. Aquí tienes el resumen de tus aventuras.
                </p>
            </div>

            <a href="{{ route('trips.create') }}"
               class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-sm">
                + Crear viaje
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Estadísticas principales -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total de viajes</p>
                        <span class="text-2xl">✈️</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-3">
                        {{ $totalTrips }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Viajes registrados
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Próximos viajes</p>
                        <span class="text-2xl">🧳</span>
                    </div>
                    <p class="text-3xl font-bold text-indigo-600 mt-3">
                        {{ $upcomingTrips->count() }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Pendientes de comenzar
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Viajes activos</p>
                        <span class="text-2xl">🌍</span>
                    </div>
                    <p class="text-3xl font-bold text-green-600 mt-3">
                        {{ $activeTrips->count() }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Actualmente en curso
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Viajes completados</p>
                        <span class="text-2xl">🏆</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-3">
                        {{ $completedTrips->count() }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Aventuras finalizadas
                    </p>
                </div>

            </div>

            <!-- Presupuesto -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-7">
                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Resumen económico
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Presupuesto y gastos de todos tus viajes.
                        </p>
                    </div>

                    <a href="{{ route('trips.index') }}"
                       class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        Ver mis viajes →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-blue-50 dark:bg-gray-700 rounded-xl p-5">
                        <p class="text-sm text-gray-500 dark:text-gray-300">
                            Presupuesto total
                        </p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-2">
                            {{ number_format($totalBudget, 2, ',', '.') }} €
                        </p>
                    </div>

                    <div class="bg-orange-50 dark:bg-gray-700 rounded-xl p-5">
                        <p class="text-sm text-gray-500 dark:text-gray-300">
                            Total gastado
                        </p>
                        <p class="text-2xl font-bold text-orange-600 mt-2">
                            {{ number_format($totalSpent, 2, ',', '.') }} €
                        </p>
                    </div>

                    <div class="bg-green-50 dark:bg-gray-700 rounded-xl p-5">
                        <p class="text-sm text-gray-500 dark:text-gray-300">
                            Presupuesto restante
                        </p>
                        <p class="text-2xl font-bold {{ $remainingBudget >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                            {{ number_format($remainingBudget, 2, ',', '.') }} €
                        </p>
                    </div>
                </div>
            </div>

            <!-- Próximos viajes -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-7">
                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Próximos viajes
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Tus próximas aventuras.
                        </p>
                    </div>

                    <a href="{{ route('trips.index') }}"
                       class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        Ver todos →
                    </a>
                </div>

                @if ($upcomingTrips->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            No tienes viajes programados próximamente.
                        </p>
                        <a href="{{ route('trips.create') }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Planificar un viaje
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ($upcomingTrips->take(4) as $trip)
                            <a href="{{ route('trips.show', $trip) }}"
                               class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:shadow-md transition">

                                <div class="flex justify-between items-start gap-3">
                                    <h4 class="font-bold text-gray-800 dark:text-gray-100 text-lg">
                                        {{ $trip->name }}
                                    </h4>

                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-100 text-indigo-700">
                                        Próximo
                                    </span>
                                </div>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">
                                    {{ $trip->start_date->format('d/m/Y') }}
                                    — {{ $trip->end_date->format('d/m/Y') }}
                                </p>

                                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $trip->destinations->count() }} destinos
                                    </span>

                                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                        Ver viaje →
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Actividades próximas y equipaje -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Actividades -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-7">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                        Próximas actividades
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-6">
                        Actividades que tienes planificadas.
                    </p>

                    @if ($upcomingActivities->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">
                            No tienes actividades próximas.
                        </p>
                    @else
                        <div class="space-y-4">
                            @foreach ($upcomingActivities as $activity)
                                <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                    <div class="flex flex-col items-center justify-center bg-indigo-100 dark:bg-gray-600 rounded-lg px-3 min-w-16">
                                        <span class="text-xs text-indigo-600 dark:text-indigo-300 font-semibold">
                                            {{ $activity->activity_date->format('M') }}
                                        </span>
                                        <span class="text-xl font-bold text-indigo-700 dark:text-indigo-200">
                                            {{ $activity->activity_date->format('d') }}
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <h4 class="font-semibold text-gray-800 dark:text-gray-100">
                                            {{ $activity->name }}
                                        </h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                            {{ $activity->destination_name }} · {{ $activity->trip_name }}
                                        </p>
                                        @if ($activity->start_time)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ \Illuminate\Support\Str::substr($activity->start_time, 0, 5) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Equipaje -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-7">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                        Progreso del equipaje
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-6">
                        Estado de las listas de equipaje de tus viajes.
                    </p>

                    <div class="text-center py-4">
                        <p class="text-5xl font-bold text-indigo-600">
                            {{ $packingProgress }}%
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            {{ $packedItems }} de {{ $totalPackingItems }} objetos preparados
                        </p>
                    </div>

                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mt-3">
                        <div class="bg-indigo-600 h-4 rounded-full transition-all"
                             style="width: {{ $packingProgress }}%">
                        </div>
                    </div>

                    @if ($trips->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400 mt-6">
                            Crea un viaje para empezar a preparar tu equipaje.
                        </p>
                    @elseif ($totalPackingItems == 0)
                        <p class="text-center text-gray-500 dark:text-gray-400 mt-6">
                            Todavía no has añadido objetos a tus listas.
                        </p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('trips.index') }}"
                           class="block text-center px-4 py-3 bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-300 rounded-lg font-semibold hover:bg-indigo-100 dark:hover:bg-gray-600">
                            Gestionar mis listas de equipaje
                        </a>
                    </div>
                </div>

            </div>

            <!-- Viajes activos -->
            @if ($activeTrips->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-7">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-5">
                        Viajes en curso
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($activeTrips as $trip)
                            <a href="{{ route('trips.show', $trip) }}"
                               class="p-5 rounded-xl border border-green-200 dark:border-green-800 hover:shadow-md transition">
                                <div class="flex justify-between items-center gap-3">
                                    <h4 class="font-bold text-gray-800 dark:text-gray-100">
                                        {{ $trip->name }}
                                    </h4>
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                                        En curso
                                    </span>
                                </div>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">
                                    Hasta el {{ $trip->end_date->format('d/m/Y') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>