<?php

namespace App\Http\Resources;

use App\Helpers\Common;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'price' => Common::toRp($this->price),
            'image' => $this->image,
            'product_category' => new ProductCategoryResource($this->productCategory)
        ];
    }
}
