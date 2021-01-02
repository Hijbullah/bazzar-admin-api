<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'orderCode' => $this->order_code,
            'orderStatus' => $this->status,
            'orderDate' => $this->created_at->toDayDateTimeString(),

            'orderSummery' => [
                'subTotal' => $this->subtotal,
                'delivery' => $this->delivery,
                'totalQty' => $this->total_quantity,
                'totalPrice' => $this->total
            ],
            'deliveryAddress' => [
                'name' => $this->delivery_name,
                'phone' => $this->delivery_phone,
                'city' => $this->delivery_city,
                'address' => $this->delivery_address,
            ],
            'payment' => [
                'method' => $this->payment_method,
                'status' => $this->payment_status ? 'Paid' : 'Not Paid',
            ],
            'products' => collect($this->order_meta_data['products'])
                            ->map(function($product) {
                                return [
                                    'id' => $product['id'],
                                    'name' => $product['name'],
                                    'price' => $product['price'],
                                    'quantity' => $product['quantity'],
                                    'total' => $product['price'] * $product['quantity'] 
                                ];
                            })
        ];
    }
}
