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
        $userID = User::inRandomOrder()->where('role_id', 4)->first()->id;
        $gymID = User::where('id', $userID)->pluck('gym_id')[0];
        $cityID = User::where('id', $userID)->pluck('city_id')[0];

        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numerify(),
            'number_of_sessions' => $this->faker->numerify(),
            'remaining_sessions' => $this->faker->numerify(),
            'gym_id' => $gymID,
            'city_id'=> $cityID,
            'user_id' =>$userID,
            'package_id' => Package::inRandomOrder()->first()->id

        ];
    }
}
