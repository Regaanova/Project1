<?php

namespace App\Repositories\Implementations;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts(int $perPage)
    {
        return Product::paginate($perPage);
    }

    public function getProductById(int $id){
        return Product::findOrFail($id);
    }
}
