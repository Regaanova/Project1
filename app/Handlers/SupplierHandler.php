<?php

namespace App\Handlers;

use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Validation\ValidationException;

class SupplierHandler
{
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepository
    ) {}

    public function destroy(int $id)
    {
        $supplier = $this->supplierRepository->findSupplierById($id);
        if ($supplier->products()->exists()) {
            throw ValidationException::withMessages([
                'supplier' => [
                    'Supplier masih digunakan oleh product.'
                ]
            ]);
        }
        $this->supplierRepository->deleteSupplier($id);
    }
}
