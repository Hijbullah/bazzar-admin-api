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
                    'price' => [
                        'originalPrice' => $product->price,
                        'salePrice' => $product->price_after_discount,
                        'discount' => $product->discount,
                        'discountInPercentage' => round(($product->discount / $product->price) * 100)
                    ],
                    'image' => Storage::url($product->images[mt_rand(0, count($product->images) - 1)])
                ];
            }),
        ];
    }
}
