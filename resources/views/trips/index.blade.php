
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Mis viajes
            </h2>

            <a href="{{ route('trips.create') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                + Nuevo viaje
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

            @if ($trips->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-10 text-center">
                    <div class="text-5xl mb-4">✈️</div>

                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                        Todavía no tienes viajes
                    </h3>

                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        Empieza a planificar tu próxima aventura.
                    </p>

                    <a href="{{ route('trips.create') }}"
                       class="inline-block px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                        Crear mi primer viaje
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($trips as $trip)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">

                            <div class="h-36 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">
                                <span class="text-6xl">🌍</span>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                                    {{ $trip->name }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                    {{ $trip->start_date->format('d/m/Y') }}
                                    —
                                    {{ $trip->end_date->format('d/m/Y') }}
                                </p>

                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                                    {{ $trip->description ?: 'Sin descripción.' }}
                                </p>

                                <div class="flex justify-between items-center mb-5">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        Presupuesto
                                    </span>

                                    <span class="font-bold text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($trip->total_budget, 2, ',', '.') }} €
                                    </span>
                                </div>

                                <a href="{{ route('trips.show', $trip) }}"
                                   class="block text-center py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                                    Ver viaje
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>