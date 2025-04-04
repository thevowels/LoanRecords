<?php

namespace App\Http\Controllers;

use App\Http\Resources\BahtResource;
use App\Http\Resources\ConsumerResource;
use App\Models\Baht;
use App\Models\Consumer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->user()->is_admin){
            return Inertia::render('Dashboard',[
                'people' => ConsumerResource::collection(Consumer::latest()->latest('id')->paginate()),
                'total_amount' => Baht::where('is_loan', true)->sum('amount'),
            ]);
        }

        return Inertia::render('Dashboard', [
        ]);

    }
}
