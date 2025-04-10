<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function () {
    get(route('people.create'))
        ->assertRedirect(route('login'));
});

 it('returns correct component', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('people.create'))
        ->assertComponent('People/Create');


 });
