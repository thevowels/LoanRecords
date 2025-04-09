<?php

use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;


use App\Models\User;


it('requires authentication', function (){
    get(route('people.create'))
        ->assertRedirect(route('login'));
});

//it('returns correct component', function () {
//    $user = User::factory()->create();
//
//    actingAs($user)
//        ->get(route('people.create'))
//        ->assertComponent('People/Create');
//
//
//});
