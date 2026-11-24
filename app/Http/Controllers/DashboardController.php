<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Obtener los viajes del usuario
        $trips = $user->trips()
            ->with(['destinations.activities', 'expenses', 'packingItems'])
            ->orderBy('start_date')
            ->get();

        // Fecha actual
        $today = Carbon::today();

        // Estadísticas generales
        $totalTrips = $trips->count();

        $upcomingTrips = $trips
            ->filter(fn ($trip) => $trip->start_date->greaterThanOrEqualTo($today))
            ->sortBy('start_date');

        $activeTrips = $trips
            ->filter(fn ($trip) =>
                $trip->start_date->lessThanOrEqualTo($today) &&
                $trip->end_date->greaterThanOrEqualTo($today)
            );

        $completedTrips = $trips
            ->filter(fn ($trip) => $trip->end_date->lessThan($today));

        // Presupuestos y gastos
        $totalBudget = $trips->sum('total_budget');
        $totalSpent = $trips->sum(fn ($trip) => $trip->expenses->sum('amount'));
        $remainingBudget = $totalBudget - $totalSpent;

        // Próximas actividades
        $upcomingActivities = $trips
            ->flatMap(function ($trip) {
                return $trip->destinations->flatMap(function ($destination) use ($trip) {
                    return $destination->activities->map(function ($activity) use ($trip, $destination) {
                        $activity->trip_name = $trip->name;
                        $activity->destination_name = $destination->name;

                        return $activity;
                    });
                });
            })
            ->filter(fn ($activity) => $activity->activity_date->greaterThanOrEqualTo($today))
            ->sortBy(function ($activity) {
                return $activity->activity_date->format('Y-m-d') . ' ' . ($activity->start_time ?? '00:00');
            })
            ->take(5);

        // Progreso del equipaje
        $totalPackingItems = $trips->sum(fn ($trip) => $trip->packingItems->count());

        $packedItems = $trips->sum(
            fn ($trip) => $trip->packingItems->where('is_packed', true)->count()
        );

        $packingProgress = $totalPackingItems > 0
            ? round(($packedItems / $totalPackingItems) * 100)
            : 0;

        return view('dashboard', compact(
            'trips',
            'totalTrips',
            'upcomingTrips',
            'activeTrips',
            'completedTrips',
            'totalBudget',
            'totalSpent',
            'remainingBudget',
            'upcomingActivities',
            'totalPackingItems',
            'packedItems',
            'packingProgress'
        ));
    }
}