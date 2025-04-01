<?php

namespace Database\Factories;

use App\Models\Consumer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Baht>
 */


class BahtFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */





    public function definition(): array
    {
        return [
            'consumer_id' => Consumer::factory(),
            'is_loan' => true,
            'amount' => fake()->randomNumber(5, true),
        ];
    }
}
