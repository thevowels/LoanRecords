<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */


    public function __invoke(Request $request)
    {


//        $daily_return = DB::table('bahts')
//            ->where('bahts.created_at', '>=', now()->subDays(10))
//            ->join('consumers', 'bahts.consumer_id', '=', 'consumers.id')
//            ->where('is_loan', false)
//            ->where('consumers.user_id', $request->user()->id)
//            ->selectRaw('DATE(bahts.created_at) as date,  SUM(bahts.amount) as amount')
//            ->groupBy(DB::raw('DATE(bahts.created_at)'))
//            ->orderBy('date')
//            ->pluck('amount', 'date');

        $bahts = [
            'loan' => DB::table('transactions')
                ->where('transactions.currency', 'baht')
                ->where('transactions.type' , 'loan')
                ->where('transactions.created_at' , '>=', now()->subDays(15))
                ->join('debts', 'transactions.debt_id', '=', 'debts.id')
                ->join('consumers', 'debts.consumer_id', '=', 'consumers.id')
                ->join('users', 'consumers.user_id', '=', 'users.id')
                ->where('users.id', '=',$request->user()->id)
                ->selectRaw('DATE(transactions.created_at) as date, SUM(transactions.amount) as total')
                ->groupBy('date')
                ->pluck('total', 'date'),
            'return' => DB::table('transactions')
                ->where('transactions.currency', 'baht')
                ->where('transactions.type' , 'return')
                ->where('transactions.created_at' , '>=', now()->subDays(15))
                ->join('debts', 'transactions.debt_id', '=', 'debts.id')
                ->join('consumers', 'debts.consumer_id', '=', 'consumers.id')
                ->join('users', 'consumers.user_id', '=', 'users.id')
                ->where('users.id', '=',$request->user()->id)
                ->selectRaw('DATE(transactions.created_at) as date, SUM(transactions.amount) as total')
                ->groupBy('date')
                ->pluck('total', 'date'),


        ];


        if($request->user()->is_admin){
            return redirect('/admin');
        }else{
            return Inertia::render('Dashboard',[
                'people' => ConsumerResource::collection(Consumer::latest()->latest('id')->paginate()),
                'summaries' => [
                    'total_people' => Consumer::where('user_id', $request->user()->id)->count(),
                    'baht_loan' => Debt::where('currency','baht')->with('consumer')->whereHas('consumer', fn ($query) => $query->where('user_id' , auth()->id()))->sum('amount'),
                    'kyat_loan' => Debt::where('currency','kyat')->with('consumer')->whereHas('consumer', fn ($query) => $query->where('user_id' , auth()->id()))->sum('amount'),
                ],
                'series' => [
                    'bahts' => $bahts,
//                    'daily_return' => $daily_return,
                ]
            ]);
        }


    }
}
