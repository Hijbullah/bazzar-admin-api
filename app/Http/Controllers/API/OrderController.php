<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;

class OrderController extends Controller
{
    public function getOrderSummery($user) {
        $orders = Order::where('user_id', $user)->latest()->get();
        return $orders;
    }

    public function getOrderDetails($orderCode)
    {
        return Order::where('order_code', $orderCode)->with('products')->first();
    }
   
    public function getOrder(Order $order)
    {
        return response()->json($order);
    }

    public function placeOrder(StoreOrderRequest $request)
    {
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

        $this->storeOrderProduct($order, $request->order['products']);

        return response()->json($order->order_code);
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
