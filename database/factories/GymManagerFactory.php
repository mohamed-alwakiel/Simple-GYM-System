<?php

namespace Database\Factories;

use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymManager>
 */
class GymManagerFactory extends Factory
{

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        $password = 123456789;
        $gymID = Gym::inRandomOrder()->first()->id;
        $cityID = Gym::where('id', $gymID)->pluck('city_id')[0];

        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->name($gender),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'national_id' => $this->faker->numerify('##############'),
            'date_of_birth' => $this->faker->dateTimeBetween('1990-01-01', '2004-12-31')->format('Y/m/d'),
            'gender' => $gender,
            'profile_img' => 'GymMgr.Png',
            'gym_id' => $gymID,
            'city_id' => $cityID,
        ];

    }


}
