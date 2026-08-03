<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class ProductSkuService
{
    public function generate(Category $category): string
    {
        $lastProduct = Product::where('category_id', $category->id)
            ->latest()
            ->first();

        $nextNumber = 1;

        if ($lastProduct) {
            $lastNumber = (int) substr($lastProduct->sku, -6);
            $nextNumber = $lastNumber + 1;
        }

        return sprintf('%s-%06d', $category->code, $nextNumber);
    }
}
