<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Destination;
use App\Models\SavedPlace;
use Illuminate\Http\Request;

class SavedPlaceController extends Controller
{
    public function index(Request $request, Trip $trip, Destination $destination)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);

        $places = $destination->savedPlaces()
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        return view('saved-places.index', compact('trip', 'destination', 'places'));
    }

    public function create(Request $request, Trip $trip, Destination $destination)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);

        return view('saved-places.create', compact('trip', 'destination'));
    }

    public function store(Request $request, Trip $trip, Destination $destination)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
        ]);

        $destination->savedPlaces()->create($validated);

        return redirect()
            ->route('trips.destinations.saved-places.index', [$trip, $destination])
            ->with('success', '¡Lugar guardado correctamente!');
    }

    public function show(Request $request, Trip $trip, Destination $destination, SavedPlace $savedPlace)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $savedPlace = $destination->savedPlaces()->findOrFail($savedPlace->id);

        return view('saved-places.show', compact('trip', 'destination', 'savedPlace'));
    }

    public function edit(Request $request, Trip $trip, Destination $destination, SavedPlace $savedPlace)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $savedPlace = $destination->savedPlaces()->findOrFail($savedPlace->id);

        return view('saved-places.edit', compact('trip', 'destination', 'savedPlace'));
    }

    public function update(Request $request, Trip $trip, Destination $destination, SavedPlace $savedPlace)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $savedPlace = $destination->savedPlaces()->findOrFail($savedPlace->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'is_visited' => ['required', 'boolean'],
        ]);

        $savedPlace->update($validated);

        return redirect()
            ->route('trips.destinations.saved-places.index', [$trip, $destination])
            ->with('success', '¡Lugar actualizado correctamente!');
    }

    public function destroy(Request $request, Trip $trip, Destination $destination, SavedPlace $savedPlace)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $savedPlace = $destination->savedPlaces()->findOrFail($savedPlace->id);

        $savedPlace->delete();

        return redirect()
            ->route('trips.destinations.saved-places.index', [$trip, $destination])
            ->with('success', 'Lugar eliminado correctamente.');
    }
}