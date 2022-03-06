<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gym>
 */
class GymFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'cover_img'=>$this->faker->name,
            'created_at'=>$this->faker->date,
            'updated_at'=>$this->faker->date,
            'city_id' => City::inRandomOrder()->first()->id
        ];
    }
}
