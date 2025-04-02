<?php


use App\Models\Baht;
use App\Models\User;
use App\Models\Consumer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\post;


beforeEach(function () {
    $this->validData =  [
        'amount'=>10000,
        'is_loan'=>false,
        'comment' => '-'
    ];
});


it('requires authentication', function () {

    $consumer = Consumer::factory()->create();
    post(route('consumers.bahts.store', $consumer), [])
        ->assertRedirect(route('login'));
});

it('can store a baht loan record', function () {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->recycle($user)->create();

    actingAs($user)
        ->post(route('consumers.bahts.store', $consumer), [
            'amount' => 10000,
            'is_loan' => true,
        ]);
    $this->assertDatabaseHas(Baht::class, [
        'amount' => 10000,
        'is_loan' => true,
        'consumer_id' => $consumer->id,
    ]);
});

it('redirect to the consumer page', function () {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->recycle($user)->create();

    actingAs($user)
        ->post(route('consumers.bahts.store', $consumer), [
            'amount' => 10000,
            'is_loan' => true,
        ])->assertRedirect(route('people.show', $consumer));
});

it('accept only valid data', function (array $badDAta, array|string $errors) {
    $user = User::factory()->create();
    $consumer = Consumer::factory()->recycle($user)->create([
        'amount' => 50000
    ]);

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
    [['amount' => 0], 'amount'],

    [['amount' => 60000], 'amount'],
    [['amount' => 100000], 'amount'],


    [['is_loan' => null], 'is_loan'],
    [['is_loan' => 'abc'], 'is_loan'],
    [['is_loan' => 42], 'is_loan'],
    [['is_loan' => 1.5], 'is_loan'],

    [['comment'=>42], 'comment'],
    [['comment' => 1.5], 'comment'],
    [['comment' => true], 'comment'],


]);
