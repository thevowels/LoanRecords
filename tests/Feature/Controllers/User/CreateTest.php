<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function (): void {
    get(route('admin.users.create'))
        ->assertRedirect(route('login'));
});

it('allow only admin users',function (): void{
    $user = User::factory()->create();
    actingAs($user)
        ->get(route('admin.users.create'))
        ->assertForbidden();
});

it('allow admin users',function (): void{
    $admin = User::factory()->create(['is_admin' => true]);

    actingAs($admin)
        ->get(route('admin.users.create'))
        ->assertComponent('User/Create');
});
