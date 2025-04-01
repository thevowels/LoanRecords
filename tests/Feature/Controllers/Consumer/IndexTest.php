<?php

use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
use App\Models\User;

use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

it('requires authentication', function () {
    get(route('people.index'))
        ->assertRedirect(route('login'));
});

it('returns correct component', function () {
    actingAs(User::factory()->create())
    ->get(route('people.index'))
        ->assertComponent('People/Index');
});



it('passes consumers to the view', function () {
    $people = Consumer::factory(5)->create();

    $people->load('user');

    actingAs(User::factory()->create())
        ->get(route('people.index'))
        ->assertHasPaginatedResource('people', ConsumerResource::collection($people->reverse()));
});
