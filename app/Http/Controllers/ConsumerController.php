<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsumerResource;
use App\Http\Resources\DebtResource;
use App\Models\Consumer;
use App\Models\Debt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sortValue = $request->query('sort') ? $request->query('sort') : 'id';
        $sortOrder = $request->query('sortOrder') ? $request->query('sortOrder') : 'asc';

        if ($request->user()->is_admin) {
            $people = Consumer::with('user')
                ->when($request->query('query'),
                    fn (Builder $builder) => $builder->where('name', 'like', '%'.$request->query('query').'%')
                );
        } else {
            $people = Consumer::with('user')
                ->where('user_id', '=', $request->user()->id)
                ->when($request->query('query'),
                    fn (Builder $builder) => $builder->where('name', 'like', '%'.$request->query('query').'%')
                );
        }
        if ($sortValue === 'id') {
            $people = $people->latest()->latest('id');
        } else {
            $people = $people->orderBy($sortValue, $sortOrder);
        }

        return inertia('People/Index', [
            'people' => ConsumerResource::collection($people->paginate()->withQueryString()),
            'query' => $request->query('query'),
            'sort' => $request->query('sort'),
            'sortOrder' => $request->query('sortOrder'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('People/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['nullable',  'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'identification_type' => ['required'],
            'identification_number' => ['required'],
            'country' => ['required'],
            'city' => ['required'],

        ]);

        $consumer = Consumer::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return redirect(route('people.show', $consumer));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Consumer $consumer)
    {
        return inertia('People/Show', [
            'consumer' => ConsumerResource::make($consumer),
            'accounts' => DebtResource::collection(Debt::where('consumer_id', '=', $consumer->id)->latest('id')->get()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumer $consumer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumer $consumer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Consumer $consumer)
    {
        Gate::authorize('delete', [Consumer::class, $consumer]);

        $consumer->delete();

        return redirect(route('people.index'))
            ->banner('consumer archived successfully');
    }
}
