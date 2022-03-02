<?php

namespace Database\Factories;

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
        return [
            'id' => $this->faker->random(),
            'name' => $this->faker->text(20),
            'day' =>$this->faker->date,
            'started_at' => $this->faker->now(),
            'finished_at' => $this->faker->now(),
            'gym_id' =>Gym::all()->random()->id,
             //
        ];
    }
}