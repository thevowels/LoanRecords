<?php

use App\Models\Consumer;
use App\Models\User;

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
     $this->withoutExceptionHandling();
    $user = User::factory()->create();
    $consumer = Consumer::factory()->for($user)->create();
    actingAs($user)
        ->delete(route('people.destroy', $consumer));
//    dd('until here');
    $consumer->refresh();

    $this->assertSoftDeleted(Consumer::class, ['id' => $consumer->id]);
 });
