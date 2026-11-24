
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Añadir lugar a {{ $destination->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <form method="POST"
                      action="{{ route('trips.destinations.saved-places.store', [$trip, $destination]) }}">
                    @csrf

                    <div class="space-y-6">

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nombre del lugar *
                            </label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name') }}" required
                                   placeholder="Ej. Sagrada Familia"
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Categoría *
                            </label>
                            <select name="category" id="category" required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="monument" @selected(old('category') == 'monument')>Monumento</option>
                                <option value="restaurant" @selected(old('category') == 'restaurant')>Restaurante</option>
                                <option value="museum" @selected(old('category') == 'museum')>Museo</option>
                                <option value="nature" @selected(old('category') == 'nature')>Naturaleza</option>
                                <option value="shop" @selected(old('category') == 'shop')>Tienda</option>
                                <option value="activity" @selected(old('category') == 'activity')>Actividad</option>
                                <option value="other" @selected(old('category', 'other') == 'other')>Otro</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Dirección
                            </label>
                            <input type="text" name="address" id="address"
                                   value="{{ old('address') }}"
                                   placeholder="Dirección del lugar"
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Página web
                            </label>
                            <input type="url" name="website" id="website"
                                   value="{{ old('website') }}"
                                   placeholder="https://ejemplo.com"
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('website')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Descripción
                            </label>
                            <textarea name="description" id="description" rows="4"
                                      placeholder="Información adicional sobre este lugar..."
                                      class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <a href="{{ route('trips.destinations.saved-places.index', [$trip, $destination]) }}"
                           class="text-gray-600 dark:text-gray-300 hover:underline">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                            Guardar lugar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
