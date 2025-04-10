<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsumerResource;
use App\Http\Resources\DebtResource;
use App\Http\Resources\TransactionResource;
use App\Models\Consumer;
use App\Models\Debt;
use App\Models\Transaction;
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
        $data = $request->validate([
            'currency' => ['required', 'string', 'in:kyat,baht'],
            'limit' => ['required', 'numeric', 'integer',  'min:1'],
        ]);

        $response = Gate::inspect('create', [Debt::class, $person, $data['currency']]);

        if (! $response->allowed()) {
            return back()->withErrors($response->message());
        }

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
        return inertia('Debts/Show', [
            'account' => DebtResource::make($debt),
            'person' => ConsumerResource::make(Consumer::find($debt->consumer_id)),
            'transactions' => TransactionResource::collection(Transaction::where('debt_id', $debt->id)->latest()->paginate()),
        ]);
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
