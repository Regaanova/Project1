<?php

namespace App\Repositories\Interfaces;

use App\Models\Supplier;

interface SupplierRepositoryInterface
{
    public function getAllSuppliers(int $perPage);

    public function findSupplierById(int $id);

    public function createSupplier(array $data): Supplier;

    public function updateSupplier(int $id, array $data): Supplier;

    public function deleteSupplier(int $id): void;
}
