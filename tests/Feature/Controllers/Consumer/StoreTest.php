<?php

use App\Models\Consumer;
use App\Models\User;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    Storage::fake('public');

    $this->validData = [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'phone' => '123456789',
        'identification_type' => 'NRC',
        'identification_number' => '13/asdf',
        'country' => 'Thailand',
        'city' => 'Bangkok',
    ];
});

it('requires authenticatoin', function () {
    post(route('people.store'))
        ->assertRedirect(route('login'));
});

it('can store post', function () {
    $this->withoutExceptionHandling();
    $idphoto = UploadedFile::fake()->image('id_photo.jpg');
    $portraitphoto = UploadedFile::fake()->image('portrait_photo.jpg');

    $user = User::factory()->create();
    actingAs($user)
        ->post(route('people.store'),array_merge($this->validData, ['photo' => $idphoto, 'portrait' => $portraitphoto]), ['Content-Type' => 'multipart/form-data']);

    $this->assertDatabaseHas(Consumer::class, [
        ...$this->validData,
        'user_id' => $user->id,
    ]);
});

it('reject invalid data', function (array $badData, array|string $errors) {
    actingAs(User::factory()->create())
        ->post(route('people.store'), [...$this->validData, ...$badData])
        ->assertInvalid($errors);

})->with([
    [['name' => null], 'name'],
    [['name' => true], 'name'],
    [['name' => 1], 'name'],
    [['name' => 1.5],  'name'],
    [['name' => str_repeat('a', 3)], 'name'],
    [['name' => str_repeat('a', 256)], 'name'],

    [['email' => true], 'email'],
    [['email' => 1], 'email'],
    [['email' => 1.5],  'email'],
    [['email' => str_repeat('a', 3)], 'email'],
    [['email' => str_repeat('a', 256)], 'email'],

    [['phone' => null], 'phone'],
    [['phone' => true], 'phone'],
    [['phone' => 1], 'phone'],
    [['phone' => 1.5],  'phone'],
    [['phone' => str_repeat('a', 256)], 'phone'],
]);
