<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication' , function () {
    get(route('admin.users.index'))
        ->assertRedirect(route('login'));
});

it('returns correct components ', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertComponent('User/Index');
});

