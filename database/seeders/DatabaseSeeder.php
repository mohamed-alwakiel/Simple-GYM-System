<?php

namespace Database\Seeders;

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

        $this->call([
            CitySeeder::class,
            GymSeeder::class,
            PackageSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);

        Package::factory(10)->create();
        TrainingSession::factory(20)->create();
        Coach::factory(20)->create();
        CoachSession::factory(20)->create();
        Attendance::factory(20)->create();
        Gym::factory(20)->create();

        // TrainingSession::factory()->count(20)->create();
        //  foreach(TrainingSession::all() as $session){
        //      $coaches=Coach::inRandomOrder()->take(rand(1,3));
        //      $session->coaches()->attach($coaches);}
    }
}
