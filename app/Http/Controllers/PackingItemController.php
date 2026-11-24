<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\PackingItem;
use Illuminate\Http\Request;

class PackingItemController extends Controller
{
    public function index(Request $request, Trip $trip)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);

        $items = $trip->packingItems()
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        $totalItems = $items->count();
        $packedItems = $items->where('is_packed', true)->count();

        $progress = $totalItems > 0
            ? round(($packedItems / $totalItems) * 100)
            : 0;

        return view('packing-items.index', compact(
            'trip',
            'items',
            'totalItems',
            'packedItems',
            'progress'
        ));
    }

    public function create(Request $request, Trip $trip)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);

        return view('packing-items.create', compact('trip'));
    }

    public function store(Request $request, Trip $trip)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $trip->packingItems()->create($validated);

        return redirect()
            ->route('trips.packing-items.index', $trip)
            ->with('success', '¡Objeto añadido al equipaje!');
    }

    public function show(Request $request, Trip $trip, PackingItem $packingItem)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $packingItem = $trip->packingItems()->findOrFail($packingItem->id);

        return view('packing-items.show', compact('trip', 'packingItem'));
    }

    public function edit(Request $request, Trip $trip, PackingItem $packingItem)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $packingItem = $trip->packingItems()->findOrFail($packingItem->id);

        return view('packing-items.edit', compact('trip', 'packingItem'));
    }

    public function update(Request $request, Trip $trip, PackingItem $packingItem)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $packingItem = $trip->packingItems()->findOrFail($packingItem->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
            'is_packed' => ['required', 'boolean'],
        ]);

        $packingItem->update($validated);

        return redirect()
            ->route('trips.packing-items.index', $trip)
            ->with('success', '¡Objeto actualizado correctamente!');
    }

    public function destroy(Request $request, Trip $trip, PackingItem $packingItem)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $packingItem = $trip->packingItems()->findOrFail($packingItem->id);

        $packingItem->delete();

        return redirect()
            ->route('trips.packing-items.index', $trip)
            ->with('success', 'Objeto eliminado del equipaje.');
    }
}