<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'user'       => $this->whenLoaded('user', function () {
                return [
                    'id'    => $this->user->id,
                    'name'  => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),
            'total'      => $this->total,
            'status'     => ucfirst($this->status),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'items'      => $this->whenLoaded('items', function () {
                return $this->items->map(function ($item) {
                    return [
                        'product_id'   => $item->product_id,
                        'product_name' => $item->product?->name,
                        'quantity'     => $item->quantity,
                        'price'        => $item->price,
                        'subtotal'     => $item->price * $item->quantity,
                    ];
                });
            }),
        ];
    }
}
