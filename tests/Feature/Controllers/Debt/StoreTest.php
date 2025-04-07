<?php


use function Pest\Laravel\get;

it('requires authentication', function (): void {

    get(route('consumers.debts.store', 1))
        ->assertRedirect(route('login'));
});
