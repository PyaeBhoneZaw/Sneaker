<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Shoe::factory()->count(20)->create();

        User::factory()->create([
            "name" => "Pyae Bhone",
            "role" => "admin",
            "email" => "pbz@gmail.com",
        ]);


        $brands = [
            ['name' => 'Nike'],
            ['name' => 'Adidas'],
            ['name' => 'Air Jordan'],
            ['name' => 'Vans'],
        ];
        foreach ($brands as $brand) {
            Brand::factory()->create($brand);
        }

        $models = [
            ['name' => 'Dunk Low', 'brand_id' => 1],
            ['name' => 'Dunk High', 'brand_id' => 1],
            ['name' => 'Air Force 1', 'brand_id' => 1],
            ['name' => 'Air Jordan 1 Low', 'brand_id' => 3],
            ['name' => 'Air Jordan 1 High', 'brand_id' => 3],
            ['name' => 'Air Jordan 1 Mid', 'brand_id' => 3],
            ['name' => 'Air Jordan 4', 'brand_id' => 3],
            ['name' => 'Forum Low', 'brand_id' => 2],
            ['name' => 'Knu Skool', 'brand_id' => 4],
        ];
        foreach ($models as $model) {
            ShoeModel::factory()->create($model);
        }
    }
}
