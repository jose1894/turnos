<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ReasonPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'reason-list', 'module'=>'Motivos']);
        Permission::create(['name' =>'reason-create', 'module'=>'Motivos']);
        Permission::create(['name' =>'reason-read', 'module'=>'Motivos']);
        Permission::create(['name' =>'reason-update', 'module'=>'Motivos']);
        Permission::create(['name' =>'reason-delete', 'module'=>'Motivos']);
    }
}
