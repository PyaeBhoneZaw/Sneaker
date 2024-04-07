<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "Pyae Bhone",
            "role" => "admin",
            "email" => "admin@gmail.com",
            //password = password
        ]);


        $brands = [
            ['brand_name' => 'Nike'],
            ['brand_name' => 'Adidas'],
            ['brand_name' => 'Air Jordan'],
            ['brand_name' => 'Vans'],
        ];
        foreach ($brands as $brand) {
            Brand::factory()->create($brand);
        }

        $models = [
            ['model_name' => 'Dunk Low', 'brand_id' => 1],
            ['model_name' => 'Dunk High', 'brand_id' => 1],
            ['model_name' => 'Air Force 1', 'brand_id' => 1],
            ['model_name' => 'Air Jordan 1 Low', 'brand_id' => 3],
            ['model_name' => 'Air Jordan 1 High', 'brand_id' => 3],
            ['model_name' => 'Air Jordan 1 Mid', 'brand_id' => 3],
            ['model_name' => 'Air Jordan 4', 'brand_id' => 3],
            ['model_name' => 'Forum Low', 'brand_id' => 2],
            ['model_name' => 'Knu Skool', 'brand_id' => 4],
        ];
        foreach ($models as $model) {
            ShoeModel::factory()->create($model);
        }
    }
}
