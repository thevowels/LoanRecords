<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication' ,function (){
    get(route('bahts.index'))
        ->assertRedirect(route('login'));
});


it('return correct component', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('bahts.index'))
        ->assertComponent('Bahts/Index');
});
