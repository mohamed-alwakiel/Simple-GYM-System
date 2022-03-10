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
        $userID = User::inRandomOrder()->role('client')->first()->id;
        $gymID = User::where('id', $userID)->pluck('gym_id')[0];
        $cityID = User::where('id', $userID)->pluck('city_id')[0];

        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numerify('###'),
            'number_of_sessions' => 50,
            'remaining_sessions' => 40,       // if > num of session
            'package_id' => Package::inRandomOrder()->first()->id,
            'user_id' => $userID,
            'gym_id' => $gymID,
            'city_id' => $cityID,
        ];
    }
}
