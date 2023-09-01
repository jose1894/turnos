<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PeoplePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'people-list', 'module'=>'Personas']);
        Permission::create(['name' =>'people-create', 'module'=>'Personas']);
        Permission::create(['name' =>'people-read', 'module'=>'Personas']);
        Permission::create(['name' =>'people-update', 'module'=>'Personas']);
        Permission::create(['name' =>'people-delete', 'module'=>'Personas']);
    }
}
