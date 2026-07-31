<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProducts(int $perPage);

    public function getProductByid(int $id);

    public function getAllProductByCategoryId(int $categoryId);

    public function createProduct(array $data);

    public function updateProduct(int $id, array $data);

    public function deleteProduct(int $id);
}
