<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'users-list', 'module'=>'Usuarios']);
        Permission::create(['name' =>'users-create', 'module'=>'Usuarios']);
        Permission::create(['name' =>'users-read', 'module'=>'Usuarios']);
        Permission::create(['name' =>'users-update', 'module'=>'Usuarios']);
        Permission::create(['name' =>'users-delete', 'module'=>'Usuarios']);
        Permission::create(['name' =>'users-change-password', 'module'=>'Usuarios']);
    }
}
