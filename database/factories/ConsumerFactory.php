<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consumer>
 */

const id_types = [
    'NRC',
    'Passport',
    'Work Permit'

];

enum IdTypes: string
{
    case NRC = 'NRC';
    case Passport = 'Passport';
    case WorkPermit = 'Work Permit';
}

class ConsumerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => User::factory(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'identification_type' => fake()->randomElement(IdTypes::cases())->value,
            'identification_number' => fake()->phoneNumber(),

            'country' => fake()->country(),
            'city' => fake()->city(),

            'amount' => rand(1000,100000)


        ];
    }
}
