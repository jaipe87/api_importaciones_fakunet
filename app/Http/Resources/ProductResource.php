<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'features' => $this->features,
            'stock' => $this->stock,
            'image_url' => $this->image_url,
            'pdf_url' => $this->pdf_url,
            'status' => isset($this->status) ? (bool) $this->status : null,
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
