<?php

namespace Database\Seeders;

use App\Models\TrainingSession;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // TrainingSession::factory()->count(20)->create();
    // foreach(TrainingSession::all() as $session){
    //     $coaches=Coach::inRandomOrder()->take(rand(1,3))->pluck('id');
    //     $session->coaches()->attach($coaches);

    TrainingSession::factory(20)->create();
   
    }
}
