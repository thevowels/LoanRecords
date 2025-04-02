<?php

use App\Http\Resources\BahtResource;
use App\Models\Consumer;
use App\Http\Resources\ConsumerResource;
use App\Models\User;
use App\Models\Baht;


use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function(){
    get(route('people.show', 1))
        ->assertRedirect(route('login'));
});


it('returns correct component', function(){

    $consumer = Consumer::factory()->create();
    actingAs(User::factory()->create())
        ->get(route('people.show', $consumer))
        ->assertComponent('People/Show');
});

it('returns correct Consumer', function(){

    $consumer = Consumer::factory()->create();

    actingAs(User::factory()->create())
        ->get(route('people.show', $consumer))
        ->assertHasResource('consumer',  ConsumerResource::make($consumer));

});

it('retuns related records to the view', function(){

    $user = User::factory()->create();
    $consumer = Consumer::factory()->recycle($user)->create();
    $bahts = Baht::factory(5)->recycle($consumer)->create(['is_loan' => 1, 'amount' => 50]);
    Baht::factory(10)->create(['is_loan' => 1]);
    $bahts->load('consumer');
    actingAs($user)
        ->get(route('people.show', $consumer))
        ->assertHasPaginatedResource('bahts', BahtResource::collection($bahts));
});

