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
            'orginal_price' => $this->sale_price,
            'discount' => $this->discout,
            'price' => $this->price_show,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'images' => collect($this->images)->transform(function($image) {
                return Storage::url($image);
            })
        ];
    }
}
