<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'category' => [
                'id' => $this->category_id,
                'name' => $this->whenLoaded('category', function () {
                    return $this->category->name;
                }),
            ],

            'supplier' => [
                'id' => $this->supplier_id,
                'name' => $this->whenLoaded('supplier', function () {
                    return $this->supplier->name;
                }),
            ],

            'price' => $this->price,
            'stock' => $this->stock,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
