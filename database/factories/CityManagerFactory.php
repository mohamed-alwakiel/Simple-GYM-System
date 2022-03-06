<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CityManager>
 */
class CityManagerFactory extends Factory
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

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'national_id' => $this->faker->numerify('##############'),
            'profile_img' => 'CityMgr.Png',
            'role_id' => 2,
            'role_type' => 'cityManager',
            'city_id' => City::inRandomOrder()->first()->id,
        ];
    }
}
