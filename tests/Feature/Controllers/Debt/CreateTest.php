<?php


use App\Models\Consumer;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function () {
    get(route('people.debts.create', 5))
        ->assertRedirect(route('login'));
});

it('returns correct Component', function () {

    $this->withoutExceptionHandling();
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create(['user_id' => $user->id]);
    actingAs($user)
        ->get(route('people.debts.create', $consumer->id))
        ->assertComponent('Debts/Create');
});
