<?php

namespace App\Http\Controllers;

use App\Http\Resources\BahtResource;
use App\Http\Resources\ConsumerResource;
use App\Models\Baht;
use App\Models\Consumer;
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

        $daily_loan = DB::table('bahts')
            ->where('bahts.created_at', '>=', now()->subDays(10))
            ->join('consumers', 'bahts.consumer_id', '=', 'consumers.id')
            ->where('is_loan', true)
            ->where('consumers.user_id', $request->user()->id)
            ->selectRaw('DATE(bahts.created_at) as date,  SUM(bahts.amount) as amount')
            ->groupBy(DB::raw('DATE(bahts.created_at)'))
            ->orderBy('date')
            ->pluck('amount', 'date');

        $daily_return = DB::table('bahts')
            ->where('bahts.created_at', '>=', now()->subDays(10))
            ->join('consumers', 'bahts.consumer_id', '=', 'consumers.id')
            ->where('is_loan', false)
            ->where('consumers.user_id', $request->user()->id)
            ->selectRaw('DATE(bahts.created_at) as date,  SUM(bahts.amount) as amount')
            ->groupBy(DB::raw('DATE(bahts.created_at)'))
            ->orderBy('date')
            ->pluck('amount', 'date');

        if($request->user()->is_admin){
            return redirect('/admin');
        }else{
            return Inertia::render('Dashboard',[
                'people' => ConsumerResource::collection(Consumer::latest()->latest('id')->paginate()),
                'summaries' => [
                    'total_people' => Consumer::where('user_id', $request->user()->id)->count(),
                    'active_loan' => Consumer::where('user_id', $request->user()->id)->sum('amount'),
                ],
                'series' => [
                    'daily_loan' => $daily_loan,
                    'daily_return' => $daily_return,
                ]
            ]);
        }


    }
}
