<?php

namespace Database\Seeders;

use App\Models\GymManager;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GymManagerSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factories = GymManager::factory(5)->create();

        foreach ($factories as $factory) {
            $factory->assignRole('gymManager');
        }
    }
}
