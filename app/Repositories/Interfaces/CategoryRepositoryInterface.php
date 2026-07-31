<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAllCategories(int $perPage);

    public function findCategoryById(int $categoryId);

    public function findCategoryWithProductsById(int $categoryId);

    public function createCategory(array $data): Category;

    public function updateCategory(int $categoryId, array $data): Category;

    public function deleteCategory(int $categoryId): void;
}
