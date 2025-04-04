<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        if($request->user()->is_admin){
            return inertia("AdminDashboard", [
                'peoples' => ConsumerResource::collection(Consumer::all()),
            ]);
        }
        return redirect('/dashboard');
    }
}
