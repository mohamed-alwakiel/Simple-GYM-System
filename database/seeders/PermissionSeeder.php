<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Links
        Permission::create(['name' => 'show dashboard']);
        Permission::create(['name' => 'show city manager side link']);
        Permission::create(['name' => 'show gym manager side link']);
        Permission::create(['name' => 'show cities side link']);
        Permission::create(['name' => 'show gyms side link']);
        Permission::create(['name' => 'show users side link']);
        Permission::create(['name' => 'show revenue link']);


        // Create
        Permission::create(['name' => 'create city manager']);
        Permission::create(['name' => 'create gym manager']);
        Permission::create(['name' => 'create city']);
        Permission::create(['name' => 'create gym']);
        Permission::create(['name' => 'create coach']);
        Permission::create(['name' => 'create package']);
        Permission::create(['name' => 'create session']);

        // Retrieve
        Permission::create(['name' => 'read city manager']);
        Permission::create(['name' => 'read gym manager']);
        Permission::create(['name' => 'read city']);
        Permission::create(['name' => 'read gym']);
        Permission::create(['name' => 'read coach']);
        Permission::create(['name' => 'read package']);
        Permission::create(['name' => 'read session']);

        // Update
        Permission::create(['name' => 'update city manager']);
        Permission::create(['name' => 'update gym manager']);
        Permission::create(['name' => 'update city']);
        Permission::create(['name' => 'update gym']);
        Permission::create(['name' => 'update coach']);
        Permission::create(['name' => 'update package']);
        Permission::create(['name' => 'update session']);

        // Delete
        Permission::create(['name' => 'delete city manager']);
        Permission::create(['name' => 'delete gym manager']);
        Permission::create(['name' => 'delete city']);
        Permission::create(['name' => 'delete gym']);
        Permission::create(['name' => 'delete coach']);
        Permission::create(['name' => 'delete package']);
        Permission::create(['name' => 'delete session']);

        // other
        Permission::create(['name' => 'assign coach']);
        Permission::create(['name' => 'read revenue']);


    }
}
