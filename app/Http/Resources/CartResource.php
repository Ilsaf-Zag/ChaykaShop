<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = $this->product;
        return [
            'id' => $this->id,
            'product_slug' => $product->slug,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $this->quantity,
        ];
    }
}
