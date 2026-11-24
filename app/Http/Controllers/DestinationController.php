<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Trip $trip)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $destinations = $trip->destinations()
            ->orderBy('position')
            ->get();

        return view('destinations.index', compact('trip', 'destinations'));
    }

    public function create(Trip $trip)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        return view('destinations.create', compact('trip'));
    }

    public function store(Request $request, Trip $trip)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'arrival_date' => ['required', 'date', 'after_or_equal:' . $trip->start_date->format('Y-m-d'), 'before_or_equal:' . $trip->end_date->format('Y-m-d')],
            'departure_date' => ['required', 'date', 'after_or_equal:arrival_date', 'before_or_equal:' . $trip->end_date->format('Y-m-d')],
        ]);

        $validated['position'] = $trip->destinations()->count();

        $trip->destinations()->create($validated);

        return redirect()
            ->route('trips.destinations.index', $trip)
            ->with('success', '¡Destino añadido correctamente!');
    }

    public function show(Trip $trip, Destination $destination)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $destination = $trip->destinations()
            ->findOrFail($destination->id);

        return view('destinations.show', compact('trip', 'destination'));
    }

    public function edit(Trip $trip, Destination $destination)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $destination = $trip->destinations()
            ->findOrFail($destination->id);

        return view('destinations.edit', compact('trip', 'destination'));
    }

    public function update(Request $request, Trip $trip, Destination $destination)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $destination = $trip->destinations()
            ->findOrFail($destination->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'arrival_date' => ['required', 'date', 'after_or_equal:' . $trip->start_date->format('Y-m-d'), 'before_or_equal:' . $trip->end_date->format('Y-m-d')],
            'departure_date' => ['required', 'date', 'after_or_equal:arrival_date', 'before_or_equal:' . $trip->end_date->format('Y-m-d')],
        ]);

        $destination->update($validated);

        return redirect()
            ->route('trips.destinations.index', $trip)
            ->with('success', '¡Destino actualizado correctamente!');
    }

    public function destroy(Trip $trip, Destination $destination)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $destination = $trip->destinations()
            ->findOrFail($destination->id);

        $destination->delete();

        return redirect()
            ->route('trips.destinations.index', $trip)
            ->with('success', 'Destino eliminado correctamente.');
    }
}