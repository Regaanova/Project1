<?php

namespace App\Handlers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Validation\ValidationException;

class CategoryHandler
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository) {}

    public function destroy(int $id)
    {
        $category = $this->categoryRepository->findCategoryById($id);
        if ($category->products()->exists()) {
            throw ValidationException::withMessages([
                'category' => [
                    'Kategori masih digunakan oleh product.'
                ]
            ]);
        }
        $this->categoryRepository->deleteCategory($id);
    }
}
