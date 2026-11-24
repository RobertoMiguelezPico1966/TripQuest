<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar objeto: {{ $packingItem->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <form method="POST"
                      action="{{ route('trips.packing-items.update', [$trip, $packingItem]) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        <div>
                            <x-input-label for="name" value="Nombre del objeto" />
                            <x-text-input id="name" name="name" type="text"
                                class="mt-1 block w-full"
                                :value="old('name', $packingItem->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Categoría" />

                            <select id="category" name="category"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                required>
                                @foreach ([
                                    'ropa' => 'Ropa',
                                    'higiene' => 'Higiene',
                                    'electronica' => 'Electrónica',
                                    'documentos' => 'Documentos',
                                    'accesorios' => 'Accesorios',
                                    'medicamentos' => 'Medicamentos',
                                    'otros' => 'Otros'
                                ] as $value => $label)
                                    <option value="{{ $value }}"
                                        @selected(old('category', $packingItem->category) === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="quantity" value="Cantidad" />
                            <x-text-input id="quantity" name="quantity" type="number"
                                min="1" step="1"
                                class="mt-1 block w-full"
                                :value="old('quantity', $packingItem->quantity)" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="notes" value="Notas (opcional)" />

                            <textarea id="notes" name="notes" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ old('notes', $packingItem->notes) }}</textarea>

                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3">
                            <input type="hidden" name="is_packed" value="0">

                            <input id="is_packed" name="is_packed" type="checkbox" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                @checked(old('is_packed', $packingItem->is_packed))>

                            <label for="is_packed"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Ya he preparado este objeto
                            </label>

                            <x-input-error :messages="$errors->get('is_packed')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8">
                        <a href="{{ route('trips.packing-items.index', $trip) }}"
                           class="text-gray-600 dark:text-gray-300 hover:underline">
                            Cancelar
                        </a>

                        <x-primary-button>
                            Guardar cambios
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
