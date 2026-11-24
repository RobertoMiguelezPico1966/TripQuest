<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Destination;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request, Trip $trip, Destination $destination)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);

        $activities = $destination->activities()
            ->orderBy('activity_date')
            ->orderBy('start_time')
            ->get();

        return view('activities.index', compact('trip', 'destination', 'activities'));
    }

    public function create(Request $request, Trip $trip, Destination $destination)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);

        return view('activities.create', compact('trip', 'destination'));
    }

    public function store(Request $request, Trip $trip, Destination $destination)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'activity_date' => [
                'required',
                'date',
                'after_or_equal:' . $destination->arrival_date->format('Y-m-d'),
                'before_or_equal:' . $destination->departure_date->format('Y-m-d'),
            ],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i', 'after:start_time'],
            'location' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
        ]);

        $destination->activities()->create($validated);

        return redirect()
            ->route('trips.destinations.activities.index', [$trip, $destination])
            ->with('success', '¡Actividad añadida correctamente!');
    }

    public function show(Request $request, Trip $trip, Destination $destination, Activity $activity)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $activity = $destination->activities()->findOrFail($activity->id);

        return view('activities.show', compact('trip', 'destination', 'activity'));
    }

    public function edit(Request $request, Trip $trip, Destination $destination, Activity $activity)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $activity = $destination->activities()->findOrFail($activity->id);

        return view('activities.edit', compact('trip', 'destination', 'activity'));
    }

    public function update(Request $request, Trip $trip, Destination $destination, Activity $activity)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $activity = $destination->activities()->findOrFail($activity->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'activity_date' => [
                'required',
                'date',
                'after_or_equal:' . $destination->arrival_date->format('Y-m-d'),
                'before_or_equal:' . $destination->departure_date->format('Y-m-d'),
            ],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i', 'after:start_time'],
            'location' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
        ]);

        $activity->update($validated);

        return redirect()
            ->route('trips.destinations.activities.index', [$trip, $destination])
            ->with('success', '¡Actividad actualizada correctamente!');
    }

    public function destroy(Request $request, Trip $trip, Destination $destination, Activity $activity)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $destination = $trip->destinations()->findOrFail($destination->id);
        $activity = $destination->activities()->findOrFail($activity->id);

        $activity->delete();

        return redirect()
            ->route('trips.destinations.activities.index', [$trip, $destination])
            ->with('success', 'Actividad eliminada correctamente.');
    }
}