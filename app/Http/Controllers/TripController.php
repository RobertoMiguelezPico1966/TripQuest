<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = auth()->user()
            ->trips()
            ->latest()
            ->get();

        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        return view('trips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'total_budget' => ['required', 'numeric', 'min:0'],
        ]);

        $request->user()->trips()->create($validated);

        return redirect()
            ->route('trips.index')
            ->with('success', '¡Viaje creado correctamente!');
    }

    public function show(Request $request, Trip $trip)
{
    $trip = $request->user()
        ->trips()
        ->with(['destinations', 'expenses'])
        ->findOrFail($trip->id);

    $totalSpent = $trip->expenses->sum('amount');
    $remaining = $trip->total_budget - $totalSpent;

    return view('trips.show', compact(
        'trip',
        'totalSpent',
        'remaining'
    ));
}

    public function edit(Trip $trip)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        return view('trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'total_budget' => ['required', 'numeric', 'min:0'],
        ]);

        $trip->update($validated);

        return redirect()
            ->route('trips.show', $trip)
            ->with('success', '¡Viaje actualizado correctamente!');
    }

    public function destroy(Trip $trip)
    {
        $trip = auth()->user()->trips()->findOrFail($trip->id);

        $trip->delete();

        return redirect()
            ->route('trips.index')
            ->with('success', 'Viaje eliminado correctamente.');
    }
}
