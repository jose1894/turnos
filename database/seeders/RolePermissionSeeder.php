<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'roles-list', 'module'=>'Roles']);
        Permission::create(['name' =>'roles-create', 'module'=>'Roles']);
        Permission::create(['name' =>'roles-read', 'module'=>'Roles']);
        Permission::create(['name' =>'roles-update', 'module'=>'Roles']);
        Permission::create(['name' =>'roles-delete', 'module'=>'Roles']);
    }
}
