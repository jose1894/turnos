<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrador',
            'lastname' => '',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' =>  Hash::make('tsj4DM1N2023/#$.'), // password
            'remember_token' => Str::random(10),
            //'office_id' => Office::where('status',1)->inRandomOrder()->get()->first()->id,
            'office_id' => 1,
        ]);

        $user->assignRole('Superadmin');
    }
}
