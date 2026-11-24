<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar destino: {{ $destination->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-8">

                <form method="POST" action="{{ route('trips.destinations.update', [$trip, $destination]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nombre del destino
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $destination->name) }}"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            País
                        </label>

                        <input
                            type="text"
                            id="country"
                            name="country"
                            value="{{ old('country', $destination->country) }}"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        >

                        @error('country')
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
                        >{{ old('description', $destination->description) }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="arrival_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de llegada
                            </label>

                            <input
                                type="date"
                                id="arrival_date"
                                name="arrival_date"
                                value="{{ old('arrival_date', $destination->arrival_date->format('Y-m-d')) }}"
                                min="{{ $trip->start_date->format('Y-m-d') }}"
                                max="{{ $trip->end_date->format('Y-m-d') }}"
                                required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            >

                            @error('arrival_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="departure_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de salida
                            </label>

                            <input
                                type="date"
                                id="departure_date"
                                name="departure_date"
                                value="{{ old('departure_date', $destination->departure_date->format('Y-m-d')) }}"
                                min="{{ $trip->start_date->format('Y-m-d') }}"
                                max="{{ $trip->end_date->format('Y-m-d') }}"
                                required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            >

                            @error('departure_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('trips.destinations.show', [$trip, $destination]) }}"
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