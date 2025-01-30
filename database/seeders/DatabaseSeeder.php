<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Children; // Menambahkan model Children jika diperlukan

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil ChildrenSeeder
        $this->call(ChildrenSeeder::class);
    }
}
