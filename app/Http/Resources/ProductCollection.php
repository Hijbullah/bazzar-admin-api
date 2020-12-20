<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($product){
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'quantity' => $product->quantity,
                    'orginal_price' => $product->sale_price,
                    'discount' => $product->discout,
                    'price' => $product->price_show,
                    'images' => collect($product->images)->transform(function($image) {
                        return Storage::url($image);
                    })
                ];
            }),
        ];
    }
}
