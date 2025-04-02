<?php

namespace App\Http\Controllers;

use App\Http\Resources\BahtResource;
use App\Models\Baht;
use App\Models\Consumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BahtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return inertia('Bahts/Index', [
            'bahts' => BahtResource::collection(Baht::latest()->latest('id')->paginate(20))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request, Consumer $consumer)
    {
        $validated = $request->validate([
            'amount' => ['required', 'integer', 'numeric', 'gt:0', function ($attribute, $value, $fail) use ($consumer, $request) {
                if( $request->is_loan === false &&  $consumer && $value > $consumer->amount){
                    $fail('The record amount must be less than the consumer\'s current amount.');
                }
            }],
            'is_loan' => ['required', 'boolean'],
            'comment' => ['nullable', 'string'],
        ]);

        Gate::authorize('create', [Baht::class, $consumer]);
        $baht = Baht::create([
            ...$validated,
            'consumer_id' => $consumer->id,
        ]);
        if($validated['is_loan']) {
            $consumer->increment('amount', (integer) $validated['amount']);
        }else{
            $consumer->decrement('amount', (integer) $validated['amount']);
        }

        return redirect(route('people.show', $consumer))
                    ->banner('Loan Record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Baht $baht)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Baht $baht)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Baht $baht)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Baht $baht)
    {
        //
    }
}
