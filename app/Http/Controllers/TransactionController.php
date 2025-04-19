<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use App\Models\Debt;
use App\Models\Transaction;
use App\Models\UserLimit;
use Illuminate\Http\Request;
use Inertia\Response;

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
    public function store(Request $request, Debt $debt)
    {
        //
        $data = $request->validate([
            'type' => ['required', 'string', 'in:loan,return'],
            'comment' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'integer', 'min:1',
                function ($attribute, $value, $fail) use ($request, $debt) {
                    if (! is_numeric($value)) {
                        return $fail('The amount must be a number.');
                    }
                    if(Consumer::find($debt->consumer_id)->user_id !== $request->user()->id) {
                        return $fail("You are not the person's owner");
                    }
                    if ($request->type === 'loan') {

                        $currentUserActiveLoans = Debt::join('consumers', 'debts.consumer_id', '=', 'consumers.id')
                            ->where('consumers.user_id', $request->user()->id)
                            ->where('debts.currency', $debt->currency)
                            ->sum('debts.amount');

                        if (! UserLimit::where('user_id', $request->user()->id)->where('currency', $debt->currency)) {
                            return $fail("You don't have persmission to create loan of".$debt->currency.' currency');
                        }
                        $currentUserLimit = $request->user()->limitForCurrency($debt->currency);
                        //                        dd('currentUserLimit ', $currentUserLimit);
                        if ($debt->amount + $value > $debt->limit) {
                            return $fail('Loan exceeded the available amount of '.$debt->limit - $debt->amount." {$debt->currency}");
                        } elseif ($currentUserLimit < $currentUserActiveLoans + $value) {
                            return $fail(' You have exceeded your loan amount for '.$debt->currencyCode());
                        }
                    }
                    if ($request->type === 'return') {
                        if ($debt->amount < $value) {
                            return $fail("Your debt is only {$debt->amount} {$debt->currency}");
                        }
                    }
                },
            ],
        ]);

        Transaction::create([
            ...$data,
            'debt_id' => (string) $debt->id,
            'user_id' => auth()->user()->id,
            'currency' => $debt->currency,
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
