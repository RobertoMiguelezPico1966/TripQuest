<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    Lista de equipaje — {{ $trip->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Organiza todo lo que necesitas llevar.
                </p>
            </div>

            <a href="{{ route('trips.packing-items.create', $trip) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">
                Añadir objeto
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

            <!-- Progreso del equipaje -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-gray-100">
                            Progreso de preparación
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ $packedItems }} de {{ $totalItems }} objetos preparados
                        </p>
                    </div>

                    <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ $progress }}%
                    </span>
                </div>

                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                    <div class="bg-indigo-600 h-3 rounded-full transition-all"
                         style="width: {{ $progress }}%">
                    </div>
                </div>
            </div>

            <!-- Lista de objetos -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                @if ($items->isEmpty())

                    <div class="text-center py-10">
                        <div class="text-4xl mb-3">🧳</div>

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Tu equipaje está vacío
                        </h3>

                        <p class="text-gray-500 dark:text-gray-400 mt-2 mb-5">
                            Añade los primeros objetos que necesitas llevar.
                        </p>

                        <a href="{{ route('trips.packing-items.create', $trip) }}"
                           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Añadir primer objeto
                        </a>
                    </div>

                @else

                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-lg flex justify-between items-center flex-wrap gap-4">

                                <div class="flex items-center gap-4">
                                    <form method="POST"
                                          action="{{ route('trips.packing-items.update', [$trip, $item]) }}">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="name" value="{{ $item->name }}">
                                        <input type="hidden" name="category" value="{{ $item->category }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                        <input type="hidden" name="notes" value="{{ $item->notes }}">
                                        <input type="hidden" name="is_packed" value="{{ $item->is_packed ? '0' : '1' }}">

                                        <button type="submit"
                                            class="w-6 h-6 rounded border-2 flex items-center justify-center
                                            {{ $item->is_packed ? 'bg-green-600 border-green-600 text-white' : 'border-gray-400' }}">
                                            @if ($item->is_packed)
                                                ✓
                                            @endif
                                        </button>
                                    </form>

                                    <div>
                                        <h4 class="font-semibold text-gray-800 dark:text-gray-100 {{ $item->is_packed ? 'line-through opacity-60' : '' }}">
                                            {{ $item->name }}
                                        </h4>

                                        <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                            {{ ucfirst($item->category) }}
                                            · Cantidad: {{ $item->quantity }}
                                        </p>

                                        @if ($item->notes)
                                            <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                                {{ $item->notes }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <a href="{{ route('trips.packing-items.show', [$trip, $item]) }}"
                                       class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-semibold">
                                        Ver
                                    </a>

                                    <a href="{{ route('trips.packing-items.edit', [$trip, $item]) }}"
                                       class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-semibold">
                                        Editar
                                    </a>

                                    <form method="POST"
                                          action="{{ route('trips.packing-items.destroy', [$trip, $item]) }}"
                                          onsubmit="return confirm('¿Quieres eliminar este objeto?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-red-600 hover:underline text-sm font-semibold">
                                            Eliminar
                                        </button>
                                    </form>
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