<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TicketsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'tickets-list', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-create', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-read', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-update', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-delete', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-attend', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-disattend', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-recall', 'module'=>'Tickets']);
        Permission::create(['name' =>'tickets-finish', 'module'=>'Tickets']);
    }
}
