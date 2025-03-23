<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Frutas y verduras'],
            ['name' => 'Carnes y aves'],
            ['name' => 'Pescados y mariscos'],
            ['name' => 'Lácteos'],
            ['name' => 'Panadería y repostería'],
        ];

        foreach($categories as $item){
            Category::create($item);
        }
    }
}
