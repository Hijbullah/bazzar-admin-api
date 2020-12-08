@extends('layouts.app')

@section('page-content')
    <nav class="text-sm font-semibold mb-8" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center text-blue-500">
                <a href="#" class="text-gray-700">Dashboard</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="text-gray-600">Blank</a>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col">
        <div class="w-full flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Categories - Create</h2>
        </div>
        
        <div class="mt-6">
            @if (session('status'))
                <template  
                    x-data="{show: true}" 
                    x-if="show"
                  >
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('status') }}</span>
                        <span @click.prevent="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                </template>
            @endif
            
            <form action="{{ route('categories.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label for="name" class="block text-sm mb-2">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Category Name">
                    
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-5">
                    <label for="parent" class="block text-sm mb-2">Parent Category</label>
    
                    <select name="parent" id="parent" class="block px-2 py-2 w-1/2 text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500">
                        <option selected value="0">No Parent</option>
                        @foreach ($categories as $category)
                            <option @if(old('parent') == $category->id) selected @endif) value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('parent')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
    
                <div>
                    <button type="submit" class="mr-3 px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-500 focus:outline-none">
                        Save Category
                    </button>
                    <a href="{{ route('categories.index') }}" class="px-3 py-2 bg-red-700 text-white rounded hover:bg-red-500 focus:outline-none">
                        Go Back
                    </a>
                </div>
            </form>

        </div>
@endsection
