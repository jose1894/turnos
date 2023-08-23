<?php

namespace Database\Seeders;

use App\Models\FinishReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinishReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinishReason::factory(10)->create();
    }
}
