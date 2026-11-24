
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    {{ $trip->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $trip->start_date->format('d/m/Y') }}
                    — {{ $trip->end_date->format('d/m/Y') }}
                </p>
            </div>

            <a href="{{ route('trips.edit', $trip) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Editar viaje
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

            <!-- Información del viaje -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-3">
                    Sobre este viaje
                </h3>

                <p class="text-gray-600 dark:text-gray-300">
                    {{ $trip->description ?: 'No hay descripción para este viaje.' }}
                </p>
            </div>

            <!-- Presupuesto -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Presupuesto total
                    </p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-2">
                        {{ number_format($trip->total_budget, 2, ',', '.') }} €
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total gastado
                    </p>
                    <p class="text-2xl font-bold text-orange-600 mt-2">
                        {{ number_format($totalSpent, 2, ',', '.') }} €
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Presupuesto restante
                    </p>
                    <p class="text-2xl font-bold {{ $remaining >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                        {{ number_format($remaining, 2, ',', '.') }} €
                    </p>
                </div>

            </div>

            <!-- Destinos -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">

                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Destinos
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Organiza las paradas de tu viaje.
                        </p>
                    </div>

                    <a href="{{ route('trips.destinations.index', $trip) }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                        Gestionar destinos
                    </a>
                </div>

                @if ($trip->destinations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            Todavía no has añadido ningún destino.
                        </p>

                        <a href="{{ route('trips.destinations.create', $trip) }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Añadir primer destino
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($trip->destinations as $destination)
                            <a href="{{ route('trips.destinations.show', [$trip, $destination]) }}"
                               class="block p-5 bg-gray-50 dark:bg-gray-700 rounded-lg hover:shadow-md transition">

                                <h4 class="font-semibold text-gray-800 dark:text-gray-100">
                                    {{ $destination->name }}
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                    {{ $destination->country }}
                                </p>

                                <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                                    {{ $destination->arrival_date->format('d/m/Y') }}
                                    — {{ $destination->departure_date->format('d/m/Y') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- Gastos -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">

                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Gastos
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Controla los gastos de tu viaje.
                        </p>
                    </div>

                    <a href="{{ route('trips.expenses.index', $trip) }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                        Gestionar gastos
                    </a>
                </div>

                @if ($trip->expenses->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            Todavía no has registrado ningún gasto.
                        </p>

                        <a href="{{ route('trips.expenses.create', $trip) }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Añadir primer gasto
                        </a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($trip->expenses->sortByDesc('expense_date')->take(5) as $expense)
                            <div class="flex justify-between items-center gap-4 flex-wrap p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $expense->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                        {{ $expense->expense_date->format('d/m/Y') }}
                                        · {{ ucfirst($expense->category) }}
                                    </p>
                                </div>

                                <p class="font-bold text-gray-800 dark:text-gray-100">
                                    {{ number_format($expense->amount, 2, ',', '.') }} €
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- Lista de equipaje -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">

                <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Lista de equipaje
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Prepara todo lo necesario para tu viaje.
                        </p>
                    </div>

                    <a href="{{ route('trips.packing-items.index', $trip) }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                        Gestionar equipaje
                    </a>
                </div>

                @php
                    $packingItems = $trip->packingItems;
                    $totalPackingItems = $packingItems->count();
                    $packedPackingItems = $packingItems->where('is_packed', true)->count();

                    $packingProgress = $totalPackingItems > 0
                        ? round(($packedPackingItems / $totalPackingItems) * 100)
                        : 0;
                @endphp

                <div class="mb-5">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 dark:text-gray-300">
                            {{ $packedPackingItems }} de {{ $totalPackingItems }} objetos preparados
                        </span>

                        <span class="font-bold text-indigo-600 dark:text-indigo-400">
                            {{ $packingProgress }}%
                        </span>
                    </div>

                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                        <div class="bg-indigo-600 h-3 rounded-full"
                             style="width: {{ $packingProgress }}%">
                        </div>
                    </div>
                </div>

                @if ($packingItems->isEmpty())
                    <p class="text-center text-gray-500 dark:text-gray-400 py-5">
                        Todavía no has añadido objetos al equipaje.
                    </p>
                @else
                    <div class="space-y-3">
                        @foreach ($packingItems->take(5) as $item)
                            <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $item->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        {{ ucfirst($item->category) }} · Cantidad: {{ $item->quantity }}
                                    </p>
                                </div>

                                <span class="text-sm font-semibold {{ $item->is_packed ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $item->is_packed ? 'Preparado' : 'Pendiente' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <div class="mt-6">
                <a href="{{ route('trips.index') }}"
                   class="text-gray-600 dark:text-gray-300 hover:underline">
                    ← Volver a mis viajes
                </a>
            </div>

        </div>
    </div>
</x-app-layout>