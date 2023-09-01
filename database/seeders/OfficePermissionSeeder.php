<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class OfficePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'offices-list', 'module'=>'Oficinas']);
        Permission::create(['name' =>'offices-create', 'module'=>'Oficinas']);
        Permission::create(['name' =>'offices-read', 'module'=>'Oficinas']);
        Permission::create(['name' =>'offices-update', 'module'=>'Oficinas']);
        Permission::create(['name' =>'offices-delete', 'module'=>'Oficinas']);
    }
}
