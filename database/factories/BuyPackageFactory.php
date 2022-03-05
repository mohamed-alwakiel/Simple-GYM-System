<?php

namespace Database\Factories;

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
            'gym_id'=>$this->faker->numerify(),
            'user_id'=>$this->faker->numerify(),
            'package_id'=>$this->faker->numerify()
        ];
    }
}
