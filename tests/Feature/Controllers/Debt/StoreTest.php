<?php

use App\Models\User;
use App\Models\Consumer;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->validData = [
        'type' => 'kyat',
        'limit'=> 30000
    ];
});

it('requires authentication', function (): void {
    $user = User::factory()->create();

    post(route('people.debts.store', 1))
        ->assertRedirect(route('login'));
});


it('can store a debt', function (): void {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create();

    actingAs($user)
        ->post(route('people.debts.store', $consumer->id), [
            ...$this->validData
        ]);

    $this->assertDatabaseHas('debts', [
        'consumer_id' => $consumer->id,
        'type' => $this->validData['type'],
        'limit' => $this->validData['limit'],
    ]);
});


it('redirects to people show page', function (): void {

    $this->withoutExceptionHandling();
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create();

    actingAs($user)
        ->post(route('people.debts.store', $consumer->id), [
            ...$this->validData
        ])
        ->assertRedirect(route('people.show', $consumer->id));

});

