<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class FinishReasonPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'finish-reason-list', 'module'=>'Motivo de finalizacion']);
        Permission::create(['name' =>'finish-reason-create', 'module'=>'Motivo de finalizacion']);
        Permission::create(['name' =>'finish-reason-read', 'module'=>'Motivo de finalizacion']);
        Permission::create(['name' =>'finish-reason-update', 'module'=>'Motivo de finalizacion']);
        Permission::create(['name' =>'finish-reason-delete', 'module'=>'Motivo de finalizacion']);
    }
}
