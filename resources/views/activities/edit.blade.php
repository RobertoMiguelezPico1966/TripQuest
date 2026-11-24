
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar actividad: {{ $activity->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <form method="POST"
                      action="{{ route('trips.destinations.activities.update', [$trip, $destination, $activity]) }}"
                      class="space-y-6">

                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nombre de la actividad
                        </label>
                        <input id="name" name="name" type="text" required
                               value="{{ old('name', $activity->name) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descripción
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('description', $activity->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="activity_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Fecha
                        </label>
                        <input id="activity_date" name="activity_date" type="date" required
                               min="{{ $destination->arrival_date->format('Y-m-d') }}"
                               max="{{ $destination->departure_date->format('Y-m-d') }}"
                               value="{{ old('activity_date', $activity->activity_date->format('Y-m-d')) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('activity_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Hora de inicio
                            </label>
                            <input id="start_time" name="start_time" type="time"
                                   value="{{ old('start_time', $activity->start_time ? substr($activity->start_time, 0, 5) : '') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('start_time')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Hora de finalización
                            </label>
                            <input id="end_time" name="end_time" type="time"
                                   value="{{ old('end_time', $activity->end_time ? substr($activity->end_time, 0, 5) : '') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('end_time')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Ubicación
                        </label>
                        <input id="location" name="location" type="text"
                               value="{{ old('location', $activity->location) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('location')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Categoría
                        </label>
                        <select id="category" name="category" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="visita" @selected(old('category', $activity->category) === 'visita')>Visita</option>
                            <option value="comida" @selected(old('category', $activity->category) === 'comida')>Comida</option>
                            <option value="transporte" @selected(old('category', $activity->category) === 'transporte')>Transporte</option>
                            <option value="ocio" @selected(old('category', $activity->category) === 'ocio')>Ocio</option>
                            <option value="compras" @selected(old('category', $activity->category) === 'compras')>Compras</option>
                            <option value="otro" @selected(old('category', $activity->category) === 'otro')>Otro</option>
                        </select>
                        @error('category')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('trips.destinations.activities.index', [$trip, $destination]) }}"
                           class="text-gray-600 dark:text-gray-300 hover:underline">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Guardar cambios
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>