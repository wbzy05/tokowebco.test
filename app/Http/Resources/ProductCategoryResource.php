<?php

namespace App\Http\Resources;

use App\Helpers\Common;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
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
            'created_at' => Common::dateFormat($this->created_at, 'dd mmm yyyy, hh:ii WIB')
        ];
    }
}
