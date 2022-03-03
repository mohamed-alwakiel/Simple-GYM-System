<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Gym;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gym>
 */
class GymFactory extends Factory
{

    protected $model = Gym::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name . 'gym',
            'cover_img' => 'Gym.jpg',
            'city_id' =>City::all()->random()->id,
        ];
    }
}
