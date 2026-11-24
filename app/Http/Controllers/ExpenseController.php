<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request, Trip $trip)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);

        $expenses = $trip->expenses()
            ->with('destination')
            ->latest('expense_date')
            ->get();

        $totalSpent = $expenses->sum('amount');
        $remaining = $trip->total_budget - $totalSpent;

        return view('expenses.index', compact(
            'trip',
            'expenses',
            'totalSpent',
            'remaining'
        ));
    }

    public function create(Request $request, Trip $trip)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);

        $destinations = $trip->destinations()
            ->orderBy('position')
            ->get();

        return view('expenses.create', compact('trip', 'destinations'));
    }

    public function store(Request $request, Trip $trip)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'category' => ['required', 'string', 'max:100'],
            'expense_date' => ['required', 'date', 'after_or_equal:' . $trip->start_date->format('Y-m-d'), 'before_or_equal:' . $trip->end_date->format('Y-m-d')],
            'destination_id' => ['nullable', 'integer'],
        ]);

        if (!empty($validated['destination_id'])) {
            $trip->destinations()->findOrFail($validated['destination_id']);
        }

        $trip->expenses()->create($validated);

        return redirect()
            ->route('trips.expenses.index', $trip)
            ->with('success', '¡Gasto registrado correctamente!');
    }

    public function show(Request $request, Trip $trip, Expense $expense)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $expense = $trip->expenses()->with('destination')->findOrFail($expense->id);

        return view('expenses.show', compact('trip', 'expense'));
    }

    public function edit(Request $request, Trip $trip, Expense $expense)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $expense = $trip->expenses()->findOrFail($expense->id);

        $destinations = $trip->destinations()
            ->orderBy('position')
            ->get();

        return view('expenses.edit', compact('trip', 'expense', 'destinations'));
    }

    public function update(Request $request, Trip $trip, Expense $expense)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $expense = $trip->expenses()->findOrFail($expense->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'category' => ['required', 'string', 'max:100'],
            'expense_date' => ['required', 'date', 'after_or_equal:' . $trip->start_date->format('Y-m-d'), 'before_or_equal:' . $trip->end_date->format('Y-m-d')],
            'destination_id' => ['nullable', 'integer'],
        ]);

        if (!empty($validated['destination_id'])) {
            $trip->destinations()->findOrFail($validated['destination_id']);
        }

        $expense->update($validated);

        return redirect()
            ->route('trips.expenses.index', $trip)
            ->with('success', '¡Gasto actualizado correctamente!');
    }

    public function destroy(Request $request, Trip $trip, Expense $expense)
    {
        $trip = $request->user()->trips()->findOrFail($trip->id);
        $expense = $trip->expenses()->findOrFail($expense->id);

        $expense->delete();

        return redirect()
            ->route('trips.expenses.index', $trip)
            ->with('success', 'Gasto eliminado correctamente.');
    }
}