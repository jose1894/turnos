<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Office::factory(10)->create();
        Office::insert([
            [
                'name' => 'Control-1',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-2',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-3',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-4',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-5',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-6',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-7',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-8',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-9',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-10',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Control-11',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'TPM-1',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'TPM-2',
                'type' => 1,
                'status' => 1,
            ],
        ]);
    }
}
