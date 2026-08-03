<?php

namespace App\Http\Controllers;

use App\Handlers\CategoryHandler;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected CategoryHandler $categoryHandler
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->categoryRepository->getAllCategories(10);
        return ResponseHelper::paginated(
            'Berhasil mendapatkan kategori.',
            $data,
            CategoryResource::collection($data)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $category = $this->categoryRepository->createCategory(
                $request->validated()
            );

            DB::commit();

            return ResponseHelper::success(
                'Kategori berhasil dibuat.',
                new CategoryResource($category),
                201
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = $this->categoryRepository->findCategoryWithProductsById($id);

        return ResponseHelper::success(
            'Berhasil mendapatkan kategori.',
            new CategoryResource($category)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->findCategoryById($id);
            $updateCategory = $this->categoryRepository->updateCategory($category->id, $request->validated());

            DB::commit();
            return ResponseHelper::success(
                'Kategori berhasil diperbarui.',
                new CategoryResource($updateCategory)
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();

        try {
            $this->categoryHandler->destroy($id);

            DB::commit();

            return ResponseHelper::success(
                'Kategori berhasil dihapus.'
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
