<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
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
            'lastname' => fake()->name(),
            'gender' => fake()->randomElement(['M' ,'F']),
            'people_type' => fake()->randomElement(['V', 'E']),
            'id_card' =>  Str::random(10),
            'status' => fake()->randomElement([0, 1]),
            'address' => fake()->text(),
        ];
    }
}
