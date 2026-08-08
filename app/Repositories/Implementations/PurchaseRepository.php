<?php

namespace App\Repositories\Implementations;

use App\Models\Purchase;
use App\Repositories\Interfaces\PurchaseRepositoryInterface;

class PurchaseRepository implements PurchaseRepositoryInterface
{
    public function getAllPurchases($perPage)
    {
        return Purchase::paginate($perPage);
    }

    public function findPurchaseById($id)
    {
        return Purchase::findOrFail($id);
    }

    public function createPurchase(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function updatePurchase($id, array $data): Purchase
    {
        $purchase = $this->findPurchaseById($id);
        $purchase->update($data);
        return $purchase;
    }

    public function deletePurchase($id): void
    {
        $purchase = $this->findPurchaseById($id);
        $purchase->delete();
    }
}
