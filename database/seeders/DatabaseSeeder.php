<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // create gym manager
        // $this->call([
        //     GitySeeder::class
        //     GymManagerSeeder::class
        //     CityManagerSeeder::class
        // ]);

        Package::factory(10)->create();
    }
}
