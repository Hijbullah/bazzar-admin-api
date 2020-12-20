@extends('layouts.app')

@section('page-content')
    <nav class="text-sm font-semibold mb-8" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center text-blue-500">
                <a href="#" class="text-gray-700">Dashboard</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="text-gray-600">Orders</a>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col">
        <div class="w-full flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Orders</h2>
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
        
        <div 
            class="mt-6 bg-white rounded overflow-x-auto"
            x-data="{
                deleteorder(action) {
                    if(confirm('Are you sure?')) {
                        let form = this.$refs.model_delete_form;
                        form.action = action;
                        form.submit();
                    }else{
                        return;
                    }
                }
            }"
        >
            <table class="w-full whitespace-no-wrap">
                <tr class="text-gray-800">
                    <td class="px-6 py-4 font-semibold">Order Id</td>
                    <td class="px-6 py-4 font-semibold">Total Amount</td>
                    <td class="px-6 py-4 font-semibold">Placed At</td>
                    <td class="px-6 py-4 font-semibold">Payment</td>
                    <td class="px-6 py-4 font-semibold">Status</td>
                    <td class="w-48 text-right px-6 py-4 font-semibold">Action</td>
                </tr>
                @forelse ($orders as $order)
                    <tr>
                        <td class="border-t px-6 py-2">{{ $order->order_code }}</td>
                        <td class="border-t px-6 py-2">{{ $order->total }}</td>
                        <td class="border-t px-6 py-2">{{ $order->created_at->diffForHumans() }}</td>
                        <td class="border-t px-6 py-2">{{ $order->payment_method }}</td>
                        <td class="border-t px-6 py-2">{{ $order->status }}</td>
                        <td class="text-right border-t px-6 py-2">
                            <a href="{{ route('orders.show', $order->order_code) }}" class="mr-3 inline-flex items-center text-green-500 hover:text-green-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            {{-- <a href="{{ route('orders.edit', $order->id) }}" class="mr-3 inline-flex items-center text-indigo-500 hover:text-indigo-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a> --}}
                            {{-- <button @click.prevent="deleteorder('{{ route('orders.destroy', $order->id) }}')" title="Delete" class="inline-flex items-center text-red-500 hover:text-red-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="border-t px-6 py-8 text-center" colspan="6">No orders found. </td>
                    </tr>
                @endforelse


                <form x-ref="model_delete_form" class="hidden" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </table>
        </div>
    </div>
@endsection
