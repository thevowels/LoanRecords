<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
//        $daily_loan = DB::table('bahts')
//            ->where('created_at', '>=', now()->subDays(10))
//            ->where('is_loan', true)
//            ->selectRaw('DATE(created_at) as date,  SUM(amount) as amount')
//            ->groupBy('date')
//            ->orderBy('date')
//            ->pluck('amount', 'date');

//        $daily_return = DB::table('bahts')
//            ->where('created_at', '>=', now()->subDays(10))
//            ->where('is_loan', false)
//            ->selectRaw('DATE(created_at) as date,  SUM(amount) as amount')
//            ->groupBy('date')
//            ->orderBy('date')
//            ->pluck('amount', 'date');

        if($request->user()->is_admin){


            return inertia("AdminDashboard", [
                'people' => ConsumerResource::collection(Consumer::paginate()),
                'summaries' => [
                    'total_users' => User::all()->count(),
                    'total_people' => Consumer::all()->count(),
//                    'active_loan' => Consumer::all()->sum('amount'),
//                    'monthly_loan' => Baht::where('is_loan', true)->where('created_at', '>=', now()->subMonth())->sum('amount'),
//                    'monthly_return' => Baht::where('is_loan', false)->where('created_at', '>=', now()->subMonth())->sum('amount'),
                ],
                'series' => [
//                        'daily_loan' => $daily_loan,
//                        'daily_return' => $daily_return,
                    ]

            ]);
        }
        return redirect('/dashboard');
    }
}
