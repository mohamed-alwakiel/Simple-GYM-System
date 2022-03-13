<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->role('client')->first()->id,
            'training_session_id' => $this->faker->randomElement(TrainingSession::all())['id'],
            'attendance_date' => $this->faker->dateTimeBetween('2021-01-20', '2023-12-31')->format('Y/m/d'),
            'attendance_time' => $this->faker->time('H_i_s'),
        ];
    }
}
