<?php

namespace Database\Factories;

use App\Models\Gym;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingSession>
 */
class TrainingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $day = $this->faker->randomElement(["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Saturday"]);

        return [
            'name' => $this->faker->text(20),
            'day' =>$day,
            'gym_id' =>Gym::all()->random()->id,
            'started_at' => date('Y-m-d H:i:s'),
            'finished_at' => date('Y-m-d H:i:s'),
        ];
    }
}
