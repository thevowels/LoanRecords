<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->validData = [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
    ];
});

it('requires authentication', function (): void {
    post(route('admin.users.store'))
        ->assertRedirect(route('login'));
});


it('allow only admin users',function (): void{
    $user = User::factory()->create();
    actingAs($user)
        ->post(route('admin.users.store'))
        ->assertForbidden();
});

it('can store new User', function (): void{
    $admin = User::factory()->create(['is_admin' => true]);

    actingAs($admin)
        ->post(route('admin.users.store', $this->validData));

    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
    ]);
});

it('can store with correct password', function (): void{
    $admin = User::factory()->create(['is_admin' => true]);

    actingAs($admin)
        ->post(route('admin.users.store', $this->validData));

    $user = User::where('email', 'john@doe.com')->first();

    $this->assertTrue(Hash::check('password', $user->password));
});

it('reject invalid data', function (array $badData, array|string $errors){
    $admin = User::factory()->create(['is_admin' => true]);

    actingAs($admin)
        ->post(route('admin.users.store', [...$this->validData, ...$badData]))
        ->assertInvalid($errors);

})->with([
    [['name' => null], 'name'],
    [['name' => true], 'name'],
    [['name' => false], 'name'],
    [['name' => 1], 'name'],
    [['name' => 1.5], 'name'],
    [['name' => str_repeat('a',3)], 'name'],
    [['name' => str_repeat('b',30)], 'name'],

    [['email' => null], 'email'],
    [['email' => true], 'email'],
    [['email' => 1], 'email'],
    [['email' => 1.5],  'email'],
    [['email' => 'email.email.com'], 'email'],
    [['email' => str_repeat('a', 3)], 'email'],
    [['email' => str_repeat('a', 256)], 'email'],

    [['password' => null], 'password'],
    [['password' => true], 'password'],
    [['password' => 1], 'password'],
    [['password' => 1.5], 'password'],
    [['password' => str_repeat('a', 7)], 'password'],

]);


it('cannot create user with same email twice', function (): void{
    $admin = User::factory()->create(['is_admin' => true]);

    $control = User::factory()->create(['email' => 'john@doe.com']);

    actingAs($admin)
        ->post(route('admin.users.store', $this->validData))
        ->assertInvalid('email');

});
