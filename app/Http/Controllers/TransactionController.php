<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Debt $debt,)
    {
        //
        $data = $request->validate([
            'type' => ['required', 'string','in:loan,return'],
            'amount' => ['required', 'numeric', 'integer', 'min:1',
                function ($attribute, $value, $fail) use ($request, $debt) {
                    if(!is_numeric($value)) {
                        return;
                    }
                    if($request->type === 'loan') {
                        if( $debt->amount + $value > $debt->limit){
                            return $fail("Loan exceeded the available amount of {($debt->limit - $value)} {$debt->currency}");
                        }
                    }
                    if($request->type === 'return') {
                        if($debt->amount < $value){
                            return $fail("Your debt is only {$debt->amount} {$debt->currency}");
                        }
                    }
                }
            ],
        ]);


        Transaction::create([
            ...$data,
            'debt_id' => (string) $debt->id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect(route('debts.show', $debt->id));

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
