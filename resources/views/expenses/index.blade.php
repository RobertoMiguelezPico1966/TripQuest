
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    Gastos de {{ $trip->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Controla los gastos y el presupuesto de tu viaje.
                </p>
            </div>

            <a href="{{ route('trips.expenses.create', $trip) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Añadir gasto
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

            <!-- Resumen del presupuesto -->
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

            <!-- Lista de gastos -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Historial de gastos
                </h3>

                @if ($expenses->isEmpty())

                    <div class="text-center py-10">
                        <div class="text-4xl mb-3">💶</div>

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Todavía no hay gastos registrados
                        </h3>

                        <p class="text-gray-500 dark:text-gray-400 mt-2 mb-5">
                            Empieza a registrar los gastos de tu viaje.
                        </p>

                        <a href="{{ route('trips.expenses.create', $trip) }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Añadir primer gasto
                        </a>
                    </div>

                @else

                    <div class="space-y-4">
                        @foreach ($expenses as $expense)
                            <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-lg flex justify-between items-center flex-wrap gap-4">

                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="font-semibold text-gray-800 dark:text-gray-100">
                                            {{ $expense->name }}
                                        </h4>

                                        <span class="text-xs px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full">
                                            {{ ucfirst($expense->category) }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                                        {{ $expense->expense_date->format('d/m/Y') }}
                                        @if ($expense->destination)
                                            · {{ $expense->destination->name }}
                                        @else
                                            · Gasto general del viaje
                                        @endif
                                    </p>

                                    @if ($expense->description)
                                        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                            {{ $expense->description }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4">
                                    <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                                        {{ number_format($expense->amount, 2, ',', '.') }} €
                                    </p>

                                    <div class="flex gap-3">
                                        <a href="{{ route('trips.expenses.show', [$trip, $expense]) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-semibold">
                                            Ver
                                        </a>

                                        <a href="{{ route('trips.expenses.edit', [$trip, $expense]) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-semibold">
                                            Editar
                                        </a>
                                    </div>
                                </div>

                            </div>
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