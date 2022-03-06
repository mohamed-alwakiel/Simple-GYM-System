<?php

namespace Database\Factories;

use App\Models\Gym;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */

class BuyPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numerify(),
            'number_of_sessions' => $this->faker->numerify(),
            'remaining_sessions' => $this->faker->numerify(),
            'gym_id' => Gym::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'package_id' => Package::inRandomOrder()->first()->id

        ];
    }
}
