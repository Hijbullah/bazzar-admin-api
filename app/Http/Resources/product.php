<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'quantity' => $this->quantity,
            'price' => [
                'originalPrice' => $this->price,
                'salePrice' => $this->price_after_discount,
                'discount' => $this->discount,
                'discountInPercentage' => round(($this->discount / $this->price) * 100)
            ],
           
            'short_description' => $this->short_description,
            'description' => $this->description,
            'images' => collect($this->images)->transform(function($image) {
                return Storage::url($image);
            }),
        ];
    }
}
