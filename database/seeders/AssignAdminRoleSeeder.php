<?php

namespace Database\Seeders;

use App\Models\CityManager;
use App\Models\GymManager;
use App\Models\User;
use Carbon\Carbon;
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
            'profile_img' => 'admin.png',
            'email_verified_at' => now(),

        ]);

        // Assign Role --> Admin
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 1,
        ]);
    }
}
