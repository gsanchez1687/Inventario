<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Manzanas',
                'description' => 'Manzana',
                'price' => 1.99,
                'stock' => 10
            ],
            [
                'category_id' => 1,
                'name' => 'Duraznos',
                'description' => 'Duraznos',
                'price' => 1.50,
                'stock' => 10
            ],
            [
                'category_id' => 1,
                'name' => 'Remolacha',
                'description' => 'Remolacha',
                'price' => 1.3,
                'stock' => 10
            ],
            [
                'category_id' => 1,
                'name' => 'Zanahorias',
                'description' => 'Zanahorias',
                'price' => 3.3,
                'stock' => 10
            ],
        ];

        foreach($products as $item){
            Product::create($item);
        }
    }
}
