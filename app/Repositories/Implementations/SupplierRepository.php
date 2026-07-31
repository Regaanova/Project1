<?php

namespace App\Repositories\Implementations;

use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getAllSuppliers(int $perPage)
    {
        return Supplier::paginate($perPage);
    }

    public function findSupplierById(int $id)
    {
        return Supplier::findOrFail($id);
    }

    public function createSupplier(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function updateSupplier(int $id, array $data): Supplier
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplier(int $id): void
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
    }
}
