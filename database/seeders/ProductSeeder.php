<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\ProductSkuService;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kategori dan jadikan "code" sebagai key
        $categories = Category::get()->keyBy('code');

        // Ambil semua id supplier
        $supplierIds = Supplier::pluck('id');

        // Ambil service generate SKU
        $skuService = app(ProductSkuService::class);
        $products = [
            [
                "category" => "ET",
                "name" => "Iphone 14 Pro Max",
                "stock" => 100,
                "buy_price" => 5000.00,
                "sell_price" => 7000.00,
            ],
            [
                "category" => "CT",
                "name" => "long sleeve shirt",
                "stock" => 50,
                "buy_price" => 8000.00,
                "sell_price" => 10000.00,
            ],
            [
                "category" => "BK",
                "name" => "Meinkampf",
                "stock" => 200,
                "buy_price" => 3000.00,
                "sell_price" => 5000.00,
            ],
        ];

        foreach ($products as $product) {

            // Cari kategori berdasarkan code
            $category = $categories[$product['category']];

            Product::create([
                'category_id' => $category->id,
                'supplier_id' => $supplierIds->random(),

                'name' => $product['name'],
                'stock' => $product['stock'],

                'buy_price' => $product['buy_price'],
                'sell_price' => $product['sell_price'],

                'sku' => $skuService->generate($category),

                'image' => null,
                'is_active' => true,
            ]);
        }
    }
}
