<?php

use App\Models\User;
use App\Models\Consumer;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;

it('requires authentication', function (): void {
    delete(route('people.destroy', 1))
        ->assertRedirect(route('login'));
});

it('user can delete only consumers which he created', function (): void {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create();

    actingAs($user)
        ->delete(route('people.destroy', $consumer))
        ->assertForbidden();
});


it('consumer can be soft deleted', function (): void {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->for($user)->create(['amount' => 0]);


    actingAs($user)
        ->delete(route('people.destroy', $consumer));
    $consumer->refresh();

    $this->assertSoftDeleted(Consumer::class, ['id' => $consumer->id]);
});
it('cannot delete consumer if their balance is not zero', function (): void {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->for($user)->create();
    $consumer->amount=100;
    $consumer->save();

    actingAs($user)
        ->delete(route('people.destroy', $consumer))
        ->assertForbidden();

});
