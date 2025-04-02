<?php

namespace App\Http\Controllers;

use App\Http\Resources\BahtResource;
use App\Models\Baht;
use App\Models\Consumer;
use Illuminate\Http\Request;

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
        //
        $valided = $request->validate([
            'amount' => ['required', 'integer', 'gte:10'],
            'is_loan' => ['required', 'boolean'],
            'comment' => ['nullable', 'string'],
        ]);

        $baht = Baht::create([
            ...$valided,
            'consumer_id' => $consumer->id,
        ]);

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
