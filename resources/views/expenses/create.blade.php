
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Añadir gasto a {{ $trip->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">

                <form method="POST" action="{{ route('trips.expenses.store', $trip) }}">
                    @csrf

                    <div class="space-y-6">

                        <div>
                            <x-input-label for="name" value="Nombre del gasto" />
                            <x-text-input id="name" name="name" type="text"
                                class="mt-1 block w-full"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Descripción (opcional)" />
                            <textarea id="description" name="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="amount" value="Importe (€)" />
                            <x-text-input id="amount" name="amount" type="number"
                                step="0.01" min="0.01"
                                class="mt-1 block w-full"
                                :value="old('amount')" required />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Categoría" />
                            <select id="category" name="category"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                required>
                                @foreach ([
                                    'alojamiento' => 'Alojamiento',
                                    'comida' => 'Comida',
                                    'transporte' => 'Transporte',
                                    'actividades' => 'Actividades',
                                    'compras' => 'Compras',
                                    'otros' => 'Otros'
                                ] as $value => $label)
                                    <option value="{{ $value }}"
                                        @selected(old('category', 'otros') === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="expense_date" value="Fecha del gasto" />
                            <x-text-input id="expense_date" name="expense_date" type="date"
                                class="mt-1 block w-full"
                                min="{{ $trip->start_date->format('Y-m-d') }}"
                                max="{{ $trip->end_date->format('Y-m-d') }}"
                                :value="old('expense_date')" required />
                            <x-input-error :messages="$errors->get('expense_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="destination_id" value="Destino (opcional)" />
                            <select id="destination_id" name="destination_id"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                <option value="">Gasto general del viaje</option>

                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}"
                                        @selected(old('destination_id') == $destination->id)>
                                        {{ $destination->name }} — {{ $destination->country }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('destination_id')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8">
                        <a href="{{ route('trips.expenses.index', $trip) }}"
                           class="text-gray-600 dark:text-gray-300 hover:underline">
                            Cancelar
                        </a>

                        <x-primary-button>
                            Guardar gasto
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>