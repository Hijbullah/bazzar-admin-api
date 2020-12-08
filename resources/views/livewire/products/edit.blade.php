<div class="mt-6">
    <form wire:submit.prevent="updateProduct">

        @csrf

        <div class="mb-5">
            <label for="category" class="block text-sm mb-2">Category</label>

            <select wire:model.lazy="product.category_id" id="category" class="w-full block px-2 py-2 text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500">
                <option disabled selected value="null">Select a Category</option>
                @each('pages.products.category-child', $categories, 'category')
            </select>

            @error('product.category_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="name" class="block text-sm mb-2">Product Name</label>
            <input type="text" wire:model.lazy="product.name" id="name" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Product Name">
            
            @error('product.name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5 flex space-x-3">
            <div class="w-1/3">
                <label for="price" class="block text-sm mb-2">Price</label>
                <input type="number" wire:model.lazy="product.sale_price" id="price" min="0" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Price">
                
                @error('product.sale_price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/3">
                <label for="discount" class="block text-sm mb-2">Discount</label>
                <input type="number" wire:model.lazy="product.discount" id="discount" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Discount ex. 100">
                
                @error('product.discount')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/3">
                <label for="quantity" class="block text-sm mb-2">Quantity</label>
                <input type="number" wire:model.lazy="product.quantity" id="quantity" min="0" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Quantity">
                
                @error('product.quantity')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        

        <div class="mb-5">
            <label for="short_description" class="block text-sm mb-2">Short Description</label>
            
            <textarea wire:model.lazy="product.short_description" id="short_description" class="h-28 block px-2 py-2 w-full resize-none text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Short Description for SEO"></textarea>
            

            @error('product.short_description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div x-data class="mb-3">
            <p class="mb-3">Product Images</p>

            <div class="relative bg-white border-2 border-gray-200 rounded">
                <div class="w-full flex items-center space-x-2 p-2">
                    @forelse ($images as $image)
                        <div class="relative h-56 w-1/4 border-2 border-gray-200 overflow-hidden">
                            <button wire:click.prevent="removeImage({{ $loop->index }})" type="button" class="absolute right-3 top-2 inline-flex items-center text-xl text-red-600 font-bold">X</button>
                            <img class="h-full w-full object-cover" src="{{ Storage::url($image) }}" alt="product iamge">
                        </div>
                    @empty
                        <div class="w-full h-56 flex justify-center items-center">
                            <p>Upload atlest one Images of products</p>
                        </div>
                    @endforelse
                </div>



                <div wire:loading wire:target="image" class="absolute inset-0 bg-gray-300">
                    <div class="w-full h-full flex justify-center items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-widest">Uploading...Please wait...</span>
                    </div>
                </div>

                <div wire:loading wire:target="removeImage" class="absolute inset-0 bg-gray-300">
                    <div class="w-full h-full flex justify-center items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-widest">Removing Image...Please wait...</span>
                    </div>
                </div>
            </div>

            @error('images')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if(count($product['images']) <= 4)
                <div class="py-3">
                    <button wire:loading.attr="disabled" wire:target="image" x-on:click.prevent="$refs.fileUploadInput.click()" class="inline-flex items-center border-b-2 border-blue-500 hover:text-blue-500 focus:outline-none">Upload Image</button>
                </div>
            @endif
            <input type="file" wire:model="image" x-ref="fileUploadInput" class="hidden">
        </div>


        <div x-data class="mb-5">
            <label for="description" class="block text-sm mb-2">Description</label>
            <div x-cloak wire:ignore>
                <trix-editor 
                    wire:model.debounce.999999ms="product.description"
                    wire:key="product_description_editor" 
                    class="trix-content h-64 overflow-y-auto bg-white border-2 border-gray-200 focus:outline-none focus:border-blue-500"
                ></trix-editor>
            </div>

            @error('product.description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="mr-3 px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-500 focus:outline-none">
                Update Product
            </button>

            <a href="{{ route('categories.index') }}" class="px-3 py-2 bg-red-700 text-white rounded hover:bg-red-500 focus:outline-none">
                Go Back
            </a>

            <div wire:loading wire:target="updateProduct">
                <p class="ml-3 text-indigo-600 font-semibold">Updating Product... please wait...</p> 
            </div>
            
            @if($errors->any())
                <p class="ml-3 text-red-600 font-semibold">Error! Please Check the inputs.</p> 
            @endif
        </div>
    </form>
</div>