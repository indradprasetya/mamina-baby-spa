<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('children')->insert([
            [
                'name' => 'John Doe',
                'birth_date' => Carbon::create('2020', '01', '01')->toDateString(),
                'weight' => 10.5,
                'height' => 75.0,
                'notes' => 'Healthy baby boy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'birth_date' => Carbon::create('2021', '06', '15')->toDateString(),
                'weight' => 8.3,
                'height' => 70.0,
                'notes' => 'Premature but growing well.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Liam Johnson',
                'birth_date' => Carbon::create('2022', '03', '23')->toDateString(),
                'weight' => 9.0,
                'height' => 72.0,
                'notes' => 'No health issues.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
