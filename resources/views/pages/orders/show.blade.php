@extends('layouts.app')

@section('page-content')
    <nav class="text-sm font-semibold mb-8" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center text-blue-500">
                <a href="#" class="text-gray-700">Dashboard</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center text-blue-500">
                <a href="#" class="text-gray-700">orders</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="text-gray-600">{{ $order->order_code }}</a>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col">
        <div class="w-full flex justify-between items-center py-3">
            <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Order #{{ $order->order_code }}</h2>
            <div class="flex items-center">
                <p>Order Status: <span class="font-bold">{{ ucfirst($order->status) }}</span></p>
                <div class="flex items-center ml-3">
                    <p class="mr-2">Marked As</p>
                    
                    <a href="{{ route('orders.status', [$order->order_code, 'received']) }}" class="inline-flex items-center px-2 py-1 border border-gray-700 ">Received</a>
                    <a href="{{ route('orders.status', [$order->order_code, 'delivered']) }}" class="inline-flex items-center px-2 py-1 border border-gray-700 ">Delivered</a>
                    <a href="{{ route('orders.status', [$order->order_code, 'cancelled']) }}" class="inline-flex items-center px-2 py-1 border border-gray-700 ">Cancelled</a>
                </div>
            </div>
        </div>

        @if (session('status'))
            <template  
                x-data="{show: true}" 
                x-if="show"
                >
                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                    <span @click.prevent="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </template>
        @endif
        
        <div class="mt-6 bg-white rounded overflow-x-auto">
           <div class="flex px-4 py-6">
                <div class="w-1/2">
                    <div>
                        <h4>Order Summery</h4>
                        <div>
                            <p>Total Order Value: {{ $order->total }}</p>
                            <p>Payment Method: {{ $order->payment_method }}</p>
                            @if($order->status != 'cod')
                                <p>Payment Status: {{ $order->payment_status ? 'Paid' : '' }}</p>
                            @endif

                            @if($order->payment_method == 'bkash')
                                <p>Transaction Id: <span class="font-bold">{{ $order->bkash_transaction_id }}</span></p>
                            @endif
                            <p>Order placed At: {{ $order->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-1/2">
                    <h4>Delivery Information</h4>
                    <div>
                        <p>{{ $order->delivery_name }}</p>
                        <p>{{ $order->delivery_phone }}</p>
                        <p>{{ $order->delivery_city }}</p>
                        <p>{{ $order->delivery_address }}</p>
                    </div>
                </div>
           </div>
        </div>
          
        <div class="mt-6">
            <h4>Products in Order</h4>
            <table class="w-full whitespace-no-wrap">
                <tr class="text-gray-800">
                    <td class="px-6 py-4 font-semibold">Qty</td>
                    <td class="px-6 py-4 font-semibold">Product</td>
                    <td class="px-6 py-4 font-semibold">Price</td>
                </tr>
                @foreach ($order->products as $product)
                    <tr>
                        <td class="border-t px-6 py-2">{{ $product->pivot->quantity }}</td>
                        <td class="border-t px-6 py-2">{{ $product->name }}</td>
                        <td class="border-t px-6 py-2">{{ $product->price_show }}</td>
                    </tr>
                @endforeach
                <tr class="text-gray-800">
                    <td colspan="2" class="text-right border-t-2 px-6 py-2">Subtotal</td>
                    <td  class="border-t-2 px-6 py-2">{{ $order->subtotal }}</td>
                </tr>
                <tr class="text-gray-800">
                    <td colspan="2" class="text-right border-t-2 px-6 py-2">Delivery</td>
                    <td  class="border-t-2 px-6 py-2">{{ $order->delivery }}</td>
                </tr>
                <tr class="text-gray-800">
                    <td colspan="2" class="text-right border-t-2 px-6 py-2">Total</td>
                    <td  class="border-t-2 px-6 py-2">{{ $order->total }}</td>
                </tr>
            </table>
        </div>
        </div>
    </div>
@endsection
