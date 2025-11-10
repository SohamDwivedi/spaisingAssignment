<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => number_format($this->price, 2),
            'stock'       => $this->stock,
            'images'      => $this->images,
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
