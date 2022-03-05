<?php

namespace Database\Seeders;

use App\Models\BuyPackage;
use App\Models\City;
use App\Models\Gym;
use App\Models\Coach;
use App\Models\Package;
use App\Models\Attendance;
use App\Models\CoachSession;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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



        City::factory(10)->create();
        Gym::factory(10)->create();
        User::factory(10)->create();
        TrainingSession::factory(10)->create();
        Coach::factory(10)->create();
        CoachSession::factory(10)->create();
        Attendance::factory(10)->create();

        Package::factory(10)->create();
        BuyPackage::factory(10)->create();





        //  foreach(TrainingSession::all() as $session){
        //      $coaches=Coach::inRandomOrder()->take(rand(1,3));
        //      $session->coaches()->attach($coaches);}
    }
}
