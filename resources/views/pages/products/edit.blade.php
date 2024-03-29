@extends('layouts.app')

@section('page-content')
    <nav class="text-sm font-semibold mb-8" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center text-blue-500">
                <a href="#" class="text-gray-700">Dashboard</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center text-blue-500">
                <a href="#" class="text-gray-700">Products</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="text-gray-600">Edit</a>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col">
        <div class="w-full flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Products - Create</h2>
        </div>

        @livewire('products.edit', ['product' => $product])
    </div>    
@endsection

@push('page-css')
    <link href="{{ asset('vendors/trix/trix.css') }}" rel="stylesheet">
    <style>
        .trix-content ul {
            list-style-type: disc;
        }
        .trix-content ol {
            list-style-type: decimal;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('vendors/trix/trix.js') }}"></script>
@endpush
