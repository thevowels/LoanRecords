<?php

namespace Database\Factories;

use App\Models\Debt;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'debt_id' => Debt::factory(),
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['loan', 'return']),
            'amount' => fake()->numberBetween(100, 1000),
            'comment' => fake()->realText(15),
        ];
    }
}
