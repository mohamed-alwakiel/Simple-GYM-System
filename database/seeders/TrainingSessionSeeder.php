<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    TrainingSession::factory()->count(20)->create();
    foreach(TrainingSession::all() as $session){
        $coaches=Coach::inRandomOrder()->take(rand(1,3))->pluck('id');
        $session->coaches()->attach($coaches);
    }
    }
}
