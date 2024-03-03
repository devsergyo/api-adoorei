<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->whenPivotLoaded('order_product', function () {
                return $this->pivot->price;
            }),
            'quantity' => $this->whenPivotLoaded('order_product', function () {
                return $this->pivot->amount;
            }),
        ];
    }
}
