<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'code' => 'ET',
                'description' => 'Electronic devices and gadgets.',
            ],
            [
                'name' => 'Clothing',
                'code' => 'CT',
                'description' => 'Apparel and fashion items.',
            ],
            [
                'name' => 'Books',
                'code' => 'BK',
                'description' => 'Printed and digital books.',
            ],
            [
                'name' => 'Home & Kitchen',
                'code' => 'HK',
                'description' => 'Household and kitchen products.',
            ],
            [
                'name' => 'Sports & Outdoors',
                'code' => 'SO',
                'description' => 'Sporting goods and outdoor equipment.',
            ],
        ];

        foreach ($categories as $category){
            Category::firstOrCreate($category);
        }
    }
}
