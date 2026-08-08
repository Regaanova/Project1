<?php

namespace App\Repositories\Interfaces;

use App\Models\Purchase;

interface PurchaseRepositoryInterface
{
    public function getAllPurchases($perPage);

    public function findPurchaseById($id);

    public function createPurchase(array $data): Purchase;

    public function updatePurchase($id, array $data): Purchase;

    public function deletePurchase($id): void;
}
