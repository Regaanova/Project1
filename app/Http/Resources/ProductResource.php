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

            'buy_price' => $this->buy_price,
            'sell_price' => $this->sell_price,

            'stock' => $this->stock,
            'sku' => $this->sku,
            'image' => $this->image,
            'is_active' => $this->is_active,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
