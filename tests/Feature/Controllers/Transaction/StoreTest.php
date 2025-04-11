<?php

use App\Models\Consumer;
use App\Models\Debt;
use App\Models\User;

use App\Models\UserLimit;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->validData = [
        'amount' => 2000,
        'type' => 'loan',
    ];
});

it('requires authentication', function () {
    post(route('debts.transactions.store', 1), [
        'amount' => 10000,
    ])->assertRedirect(route('login'));
});

 it('can store a transaction', function () {

    $user = User::factory()->create();
     UserLimit::create(['user_id' => $user->id, 'currency' => 'kyat', 'limit' => 300000]);
     $consumer = Consumer::factory()->for($user)->create();

    $debt= Debt::factory()->for($consumer)->create(['currency'=> 'kyat']);
    actingAs($user)
        ->post(route('debts.transactions.store', $debt->id), [
            'amount' => 3000,
            'type' => 'loan'
        ]);
    $this->assertDatabaseHas('transactions', [
        'amount' => 3000,
        'type' => 'loan',
        'debt_id' => $debt->id,
        'user_id' => $user->id,
    ]);
 });

 it('redirects to correct debt show page', function () {
    $user = User::factory()->create();
    UserLimit::create(['user_id' => $user->id, 'currency' => 'kyat', 'limit' => 300000]);

    $consumer = Consumer::factory()->for($user)->create();

    $debt= Debt::factory()->for($consumer)->create(['currency'=>'kyat']);
    actingAs($user)
        ->post(route('debts.transactions.store', $debt->id), [
            'amount' => 3000,
            'type' => 'loan'
        ])
        ->assertRedirect(route('debts.show', $debt->id));
 });

it('reject invalid data', function (array $badData, array|string $errors) {
    $user = User::factory()->create();

    $consumer = Consumer::factory()->for($user)->create();

    $debt = Debt::factory()->for($consumer)->create();
    actingAs($user)
        ->post(route('debts.transactions.store', $debt->id), [
            ...$this->validData,
            ...$badData,
        ])
        ->assertInvalid($errors);

})->with([
    [['amount' => null], 'amount'],
    [['amount' => true], 'amount'],
    [['amount' => 1.5], 'amount'],
    [['amount' => -8], 'amount'],
    [['amount' => 300000], 'amount'],
    [['amount' => 10000, 'type' => 'return'], 'amount'],
    [['amount' => 'abcd'], 'amount'],

    [['type' => null], 'type'],
    [['type' => true], 'type'],
    [['type' => 1.5], 'type'],
    [['type' => 42], 'type'],
    [['type' => 'loann'], 'type'],
    [['type' => 'payback'], 'type'],

]);
