<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Detalles del objeto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <div class="flex justify-between items-start gap-4 flex-wrap mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $packingItem->name }}
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            {{ ucfirst($packingItem->category) }}
                        </p>
                    </div>

                    <span class="px-3 py-2 rounded-full text-sm font-semibold
                        {{ $packingItem->is_packed ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $packingItem->is_packed ? 'Preparado' : 'Pendiente' }}
                    </span>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 space-y-5">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Cantidad
                        </p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $packingItem->quantity }}
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
                            Notas
                        </p>
                        <p class="text-gray-800 dark:text-gray-100 mt-1">
                            {{ $packingItem->notes ?: 'Sin notas adicionales.' }}
                        </p>
                    </div>

                </div>

                <div class="flex justify-between items-center flex-wrap gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('trips.packing-items.index', $trip) }}"
                       class="text-gray-600 dark:text-gray-300 hover:underline">
                        ← Volver al equipaje
                    </a>

                    <div class="flex items-center gap-3">

                        <a href="{{ route('trips.packing-items.edit', [$trip, $packingItem]) }}"
                           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('trips.packing-items.destroy', [$trip, $packingItem]) }}"
                              onsubmit="return confirm('¿Seguro que quieres eliminar este objeto?')">
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
