<?php

namespace App\Http\Controllers;

use App\Handlers\SupplierHandler;
use App\Helpers\ResponseHelper;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepository,
        protected SupplierHandler $supplierHandler
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = $this->supplierRepository->getAllSuppliers(10);
        return ResponseHelper::paginated(
            'Berhasil mendapatkan supplier.',
            $suppliers,
            SupplierResource::collection($suppliers)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        DB::beginTransaction();

        try {
            $supplier = $this->supplierRepository->createSupplier(
                $request->validated()
            );

            DB::commit();

            return ResponseHelper::success(
                'Supplier berhasil dibuat.',
                new SupplierResource($supplier),
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
        $supplier = $this->supplierRepository->findSupplierById($id);

        return ResponseHelper::success(
            'Berhasil mendapatkan supplier.',
            new SupplierResource($supplier)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, int $id)
    {
        $supplier = $this->supplierRepository->findSupplierById($id);

        DB::beginTransaction();
        try {
            $updatedSupplier = $this->supplierRepository->updateSupplier(
                $id,
                $request->validated()
            );

            DB::commit();

            return ResponseHelper::success(
                'Supplier berhasil diperbarui.',
                new SupplierResource($updatedSupplier)
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
        $supplier = $this->supplierRepository->findSupplierById($id);

        DB::beginTransaction();
        try {
            $this->supplierRepository->deleteSupplier($supplier->id);

            DB::commit();

            return ResponseHelper::success(
                'Supplier berhasil dihapus.'
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
