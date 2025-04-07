<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Consumer $person)
    {


        return inertia('Debts/Create', [
            'person' => $person->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Consumer $person)
    {
        //
        $data =$request->validate([
            'currency' => ['required', 'string', 'in:kyat,baht'],
            'limit' => ['required', 'numeric','integer',  'min:1'],
        ]);

        Gate::authorize('create', [Debt::class, $person, $data['currency']]);

        Debt::create([
            'consumer_id' => $person->id,
            ...$data,
        ]);

        return redirect(route('people.show', $person));


    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        //
    }
}
