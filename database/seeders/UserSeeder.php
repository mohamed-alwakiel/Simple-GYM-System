<?php

namespace Database\Seeders;

use App\Models\CityManager;
use App\Models\GymManager;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $factories = User::factory(20)->create();

    foreach ($factories as $factory) {
        $factory->assignRole('client');
    }
  }
}
