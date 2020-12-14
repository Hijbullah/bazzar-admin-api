<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   
    public function getOrder(Order $order)
    {
        return $order;
    }

    public function makePayment(Request $request)
    {
        return response()->json($request);
    }

    
}
