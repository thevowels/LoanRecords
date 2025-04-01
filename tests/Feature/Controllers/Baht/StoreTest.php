<?php


use App\Models\Baht;
use App\Models\User;
use App\Models\Consumer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\post;


beforeEach(function () {
    $this->validData =  [
        'amount'=>30000,
        'is_loan'=>true
    ];
});


it('requires authentication', function () {

    $consumer = Consumer::factory()->create();
    post(route('consumers.bahts.store', $consumer), [])
        ->assertRedirect(route('login'));
});

it('can store a baht loan record', function () {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create();

    actingAs($user)
        ->post(route('consumers.bahts.store', $consumer), [
            'amount' => 10000,
            'is_loan' => false,
        ]);
    $this->assertDatabaseHas(Baht::class, [
        'amount' => 10000,
        'is_loan' => false,
        'consumer_id' => $consumer->id,
    ]);
});

it('redirect to the consumer page', function () {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create();

    actingAs($user)
        ->post(route('consumers.bahts.store', $consumer), [
            'amount' => 10000,
            'is_loan' => false,
        ])->assertRedirect(route('people.show', $consumer));
});

it('accept only valid data', function (array $badDAta, array|string $errors) {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->create();

    actingAs($user)
        ->post(route('consumers.bahts.store', $consumer), [
            ...$this->validData, ...$badDAta,
        ])->assertInvalid($errors);
})->with([
    [['amount' => null], 'amount'],
    [['amount' => true], 'amount'],
    [['amount' => -1000], 'amount'],
    [['amount' => 'abc'], 'amount'],
    [['amount' => 1000.5], 'amount'],
    [['amount' => 1.5], 'amount'],
    [['amount' => 9], 'amount'],

    [['is_loan' => null], 'is_loan'],
    [['is_loan' => 'abc'], 'is_loan'],
    [['is_loan' => 42], 'is_loan'],
    [['is_loan' => 1.5], 'is_loan'],


]);
