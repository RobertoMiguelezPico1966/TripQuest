<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar viaje
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-8">

                <form method="POST" action="{{ route('trips.update', $trip) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nombre del viaje
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $trip->name) }}"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Descripción
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        >{{ old('description', $trip->description) }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de inicio
                            </label>

                            <input
                                type="date"
                                id="start_date"
                                name="start_date"
                                value="{{ old('start_date', $trip->start_date->format('Y-m-d')) }}"
                                required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            >

                            @error('start_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de finalización
                            </label>

                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                value="{{ old('end_date', $trip->end_date->format('Y-m-d')) }}"
                                required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            >

                            @error('end_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="total_budget" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Presupuesto total (€)
                        </label>

                        <input
                            type="number"
                            id="total_budget"
                            name="total_budget"
                            value="{{ old('total_budget', $trip->total_budget) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        >

                        @error('total_budget')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('trips.show', $trip) }}"
                           class="text-gray-600 dark:text-gray-300 hover:underline">
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold"
                        >
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>