<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Shoe::factory()->count(10)->create();
        Brand::factory()->count(5)->create();
        ShoeModel::factory()->count(10)->create();
    }
}
