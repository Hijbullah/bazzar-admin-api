<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;

class OrderController extends Controller
{
   
    public function getOrder(Order $order)
    {
        return $order;
    }

    public function placeOrder(StoreOrderRequest $request)
    {
        return $request->order['products'];

        $products = collect($request->products)->map(function($product) {
            return [
                $product->id
            ];
        });

        // return $request;
        $order = new Order;
        $order->order_code = Str::random(11);
        $order->user_id = $request->user;
        // $order->delivery_email = $request->address->email;
        $order->delivery_name = $request->address['name'];
        $order->delivery_phone = $request->address['phone'];
        $order->delivery_city = $request->address['city'];
        $order->delivery_address = $request->address['address'];

        $order->subtotal = $request->order['subTotal'];
        $order->delivery = $request->order['delivery'];
        $order->total_quantity = $request->order['totalQuantity'];
        $order->total = $request->order['total'];
        $order->save();




        $order->products()->attach([
            1 => ['expires' => $expires],
            2 => ['expires' => $expires],
        ]);

        return $order;
    }

    public function makePayment(Request $request)
    {
        return response()->json($request);
    }

    
}
