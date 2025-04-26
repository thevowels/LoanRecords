<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLimit;
use Illuminate\Http\Request;

class UserInfoApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request )
    {
//        $user_id= $request->input('user_id');
//        $user_limit = $request->input('user_limit');

        return $request->user();
    }
}
