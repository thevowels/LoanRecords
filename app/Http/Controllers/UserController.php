<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return inertia('User/Index', [
            'users' => function () {
                $users = UserResource::collection(User::with('limits')->paginate());

                $users->collection->transform(fn ($user) => $user->adminRequest());
                return $users;
            }
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('User/Create', [ ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:25'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        User::factory()->create([...$validated, 'password' => Hash::make($validated['password'])]);
        return redirect(route('admin'))->with(['success' => 'User created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return inertia('User/Show', [
            'user' => UserResource::make($user)->adminRequest(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return inertia('User/Edit', [
            'user' => UserResource::make($user)->adminRequest(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //

        dd($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
