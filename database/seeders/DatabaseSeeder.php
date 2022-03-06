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

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AssignAdminRoleSeeder::class,

            CitySeeder::class,
            GymSeeder::class,

            CityManagerSeeder::class,
            GymManagerSeeder::class,
            UserSeeder::class,

            PackageSeeder::class,
            BuyPackageSeeder::class,

            CoachSeeder::class,
            TrainingSessionSeeder::class,
            CoachSessionSeeder::class,

            AttendanceSeeder::class
        ]);
    }
}
