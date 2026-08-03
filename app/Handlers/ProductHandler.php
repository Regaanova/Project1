<?php

namespace App\Handlers;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductHandler
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}
    public function delete(int $id)
    {
        $product = $this->productRepository->findProductById($id);
        if ($product->transactions()->exists()) {
            throw new \Exception("Product masih digunakan oleh transaksi.");
        }
        $this->productRepository->deleteProduct($id);
    }
}
