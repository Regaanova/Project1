<?php

namespace App\Http\Controllers;

use App\Handlers\ProductHandler;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected ProductHandler $productHandler
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->productRepository->getAllProducts(10);
        return ResponseHelper::paginated(
            'Berhasil mendapatkan produk.',
            $data,
            ProductResource::collection($data)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->createProduct(
                $request->validated()
            );

            DB::commit();

            return ResponseHelper::success(
                'Produk berhasil dibuat.',
                new ProductResource($product),
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
        $product = $this->productRepository->findProductById($id);
        return ResponseHelper::success(
            'Berhasil mendapatkan produk.',
            new ProductResource($product)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->updateProduct(
                $id,
                $request->validated()
            );

            DB::commit();

            return ResponseHelper::success(
                'Produk berhasil diperbarui.',
                new ProductResource($product)
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
            $this->productRepository->deleteProduct($id);

            DB::commit();

            return ResponseHelper::success(
                'Produk berhasil dihapus.'
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
