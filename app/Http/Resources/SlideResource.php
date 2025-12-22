<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'image_url' => $this->image_url,
            'active' => (bool) $this->active,
        ];
    }
}
