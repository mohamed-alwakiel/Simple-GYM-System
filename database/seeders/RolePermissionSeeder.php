<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\GymManager;
use Illuminate\Contracts\Auth\Guard;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::find(1);
        $allPermissions=Permission::all();

        $roleAdmin->givePermissionTo($allPermissions);


        $roleCityManager = Role::find(2);
        $roleCityManager->givePermissionTo(['create gym','create gym manager','create coach','create session',

        'update gym manager','update gym','update coach','update session',

        'delete gym manager','delete gym','delete coach','delete session',

        'read gym manager','read gym','read coach','read package',

        'read session','assign coach']);

        
        $roleGymManager = Role::find(3);
        $roleGymManager->givePermissionTo(['create session','update session','delete session',
        'read session', 'read coach','read package', 'assign coach']);

    }
}
