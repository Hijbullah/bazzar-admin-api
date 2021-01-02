<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Resources\Order as OrderResource;

class OrderController extends Controller
{
    public function getOrder($orderCode)
    {
        $order = Order::whereOrderCode($orderCode)
            ->select('id', 'order_code', 'total', 'payment_method', 'created_at')
            ->firstOrFail();

        return response()->json([
            'orderCode' => $order->order_code,
            'total' => $order->total,
            'paymentMethod' => $order->payment_method,
            'orderDate' => $order->created_at->toDayDateTimeString()
        ]);
    }   

    public function getAllOrder($user)
    {
        return OrderResource::collection(Order::whereUserId($user)->latest()->get());
    }
   
    public function storeOrder(Request $request)
    {
        $order = new Order;
        $order->order_code = Str::random(11);
        $order->user_id = $request->user;
        
        $order->delivery_name = $request->address['name'];
        $order->delivery_phone = $request->address['phone'];
        $order->delivery_city = $request->address['city'];
        $order->delivery_address = $request->address['address'];

        $order->subtotal = $request->order['subTotal'];
        $order->delivery = $request->order['delivery'];
        $order->total_quantity = $request->order['totalQuantity'];
        $order->total = $request->order['total'];

        $order->payment_method = $request->paymentMethod;
        $order->order_meta_data = $request->order;

        $order->save();

        $this->storeOrderProduct($order, $request->order['products']);

        return response()->json([
            'message' => 'Order placed successfully',
            'order_code' => $order->order_code
        ]);
    }

    public function storeOrderProduct($order, $products)
    {
        collect($products)->each(function($product) use ($order) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        });
    }

    public function makePayment(Order $order, Request $request)
    {
        $request->validate([
            'transactionId' => ['required']
        ]);

        $order->payment_method = $request->paymentMethod;
        $order->bkash_transaction_id = $request->transactionId; 
        $order->payment_status = true;
        $order->save();

        return response()->json(['message' => 'Payment successfull']);
    } 
}
