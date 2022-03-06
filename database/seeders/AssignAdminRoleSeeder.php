<?php

namespace Database\Seeders;

use App\Models\CityManager;
use App\Models\GymManager;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$uQ/WIjMbfSOsAjlg0xj1E.MxED2Lef0S50uXuKEsPRTYLszqczdbG',
            'date_of_birth' => '1990-01-01',
            'role_type' => 'admin',
            'role_id' => 1,
        ]);

        // CityManager::factory(1)->create();
        // GymManager::factory(1)->create();
        // User::factory(1)->create();


        // Assign Role --> Admin
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 1,
        ]);

        // // Assign Role --> City Manager Model

        // DB::table('model_has_roles')->insert([
        //     'role_id' => 2,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => 2,
        // ]);

        // // Assign Role --> Gym Manager Model
        // DB::table('model_has_roles')->insert([
        //     'role_id' => 3,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => 3,
        // ]);

        // // Assign Role --> User Model
        // DB::table('model_has_roles')->insert([
        //     'role_id' => 4,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => 4,
        // ]);
    }
}
