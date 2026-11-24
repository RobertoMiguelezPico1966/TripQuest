<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Detalles del gasto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <div class="flex justify-between items-start gap-4 flex-wrap mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $expense->name }}
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            {{ ucfirst($expense->category) }}
                        </p>
                    </div>

                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ number_format($expense->amount, 2, ',', '.') }} €
                    </p>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 space-y-5">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Fecha del gasto
                        </p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $expense->expense_date->format('d/m/Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Destino
                        </p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $expense->destination?->name ?? 'Gasto general del viaje' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Viaje
                        </p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $trip->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Descripción
                        </p>
                        <p class="text-gray-800 dark:text-gray-100 mt-1">
                            {{ $expense->description ?: 'Sin descripción.' }}
                        </p>
                    </div>

                </div>

                <div class="flex justify-between items-center flex-wrap gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('trips.expenses.index', $trip) }}"
                       class="text-gray-600 dark:text-gray-300 hover:underline">
                        ← Volver a los gastos
                    </a>

                    <div class="flex items-center gap-3">

                        <a href="{{ route('trips.expenses.edit', [$trip, $expense]) }}"
                           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('trips.expenses.destroy', [$trip, $expense]) }}"
                              onsubmit="return confirm('¿Seguro que quieres eliminar este gasto?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold">
                                Eliminar
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
