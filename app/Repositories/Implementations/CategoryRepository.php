<?php

namespace App\Repositories\Implementations;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories(int $perPage){
        return Category::paginate($perPage);
    }

    public function findCategoryById(int $categoryId){
        return Category::findOrFail($categoryId);
    }

    public function findCategoryWithProductsById(int $categoryId){
        return Category::with('products')->findOrFail($categoryId);
    }

    public function createCategory(array $data): Category{
        return Category::create($data);
    }

    public function updateCategory(int $categoryId, array $data): Category{
        $category = Category::findOrFail($categoryId);
        $category->update($data);
        return $category;
    }

    public function deleteCategory(int $categoryId): void{
        $category = Category::findOrFail($categoryId);
        $category->delete();
    }
}
