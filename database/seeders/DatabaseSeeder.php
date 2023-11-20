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
            ['name' => 'Dunk Low'],
            ['name' => 'Dunk High'],
            ['name' => 'Air Force 1'],
            ['name' => 'Air Jordan 1 Low'],
            ['name' => 'Air Jordan 1 High'],
            ['name' => 'Air Jordan 1 Mid'],
            ['name' => 'Air Jordan 4'],
        ];
        foreach ($models as $model) {
            ShoeModel::factory()->create($model);
        }
    }
}
