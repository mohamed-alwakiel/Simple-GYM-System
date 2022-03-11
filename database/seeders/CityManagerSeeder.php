<?php

namespace Database\Seeders;

use App\Models\CityManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $factories = CityManager::factory(10)->create();

        foreach ($factories as $factory) {
            $factory->assignRole('cityManager');
        }
    }
}
