<?php

use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function () {
    get(route('people.show', 1))
        ->assertRedirect(route('login'));
});

// it('returns correct component', function(){
//
//    $consumer = Consumer::factory()->create();
//    actingAs(User::factory()->create())
//        ->get(route('people.show', $consumer))
//        ->assertComponent('People/Show');
// });
//
// it('returns correct Consumer', function(){
//
//    $consumer = Consumer::factory()->create();
//
//    actingAs(User::factory()->create())
//        ->get(route('people.show', $consumer))
//        ->assertHasResource('consumer',  ConsumerResource::make($consumer));
//
// });
//
