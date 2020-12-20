<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('pages.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('pages.orders.show', compact('order'));
    }

    public function orderStatus(Order $order, $status)
    {
        $order->status = $status;
        $order->save();
        return redirect()->route('orders.show', $order->order_code)->with('status', 'Order Status marked As ' . ucfirst($status));
    }
}
