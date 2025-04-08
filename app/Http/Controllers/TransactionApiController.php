<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $debt_id = $request->input('debt_id');
        return (TransactionResource::collection(Transaction::where('debt_id', $debt_id)->latest()->paginate()));
    }
}
