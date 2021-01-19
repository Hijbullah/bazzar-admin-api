<div class="flex flex-col">
    <div class="w-full flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Product Create</h2>
        <div wire:loading>
            <svg class="animate-spin h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
    <div class="mt-6 flex space-x-5">
        <div class="w-2/3">
            <div class="mb-5">
                <label for="name" class="block text-sm mb-2">Product Name</label>
                <input type="text" wire:model.defer="name" id="name" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Product Name">
                
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div x-data class="mb-5">
                <label for="description" class="block text-sm mb-2">Description</label>
                <div x-cloak wire:ignore>
                    <trix-editor 
                        wire:model.debounce.999999ms="description"
                        wire:key="product_description_editor" 
                        class="trix-content h-96 overflow-y-auto bg-white border-2 border-gray-200 focus:outline-none focus:border-blue-500"
                    ></trix-editor>
                </div>
                
    
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <livewire:products.product-image />

                @error('images')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center mt-5">
                <button wire:click.prevent="saveProduct" class="mr-3 px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-500 focus:outline-none">
                    Save Product
                </button>
    
                <a href="{{ route('products.index') }}" class="px-3 py-2 bg-red-700 text-white rounded hover:bg-red-500 focus:outline-none">
                    Go Back
                </a>
                
                @if($errors->any())
                    <p class="ml-3 text-red-600 text-sm">Error! Please Check the inputs.</p> 
                @endif
            </div>
        </div>
        <div class="w-1/3">
            <div class="mb-5">
                <p>Product Category</p>
    
                <div class="w-full h-64 mt-2 px-3 py-4 space-y-2 bg-white overflow-auto">
                    @each('livewire.products.category-child', $this->categories, 'category')
                </div>

                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <p>Pricing & Quantity</p>
                <div class="mt-2 px-3 py-4 space-y-3 bg-white">
                    <div>
                        <input type="number" 
                            wire:model.defer="price" 
                            id="price" 
                            min="0" 
                            class="block px-2 py-1 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" 
                            placeholder="Price">
                        
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="number" 
                            wire:model.defer="discount" 
                            id="discount" 
                            class="block px-2 py-1 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" 
                            placeholder="Discount in percentage">
                        
                        @error('discount')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="number" 
                            wire:model.defer="quantity" 
                            id="quantity" 
                            min="0" 
                            class="block px-2 py-1 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" 
                            placeholder="Quantity">
                        
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <p>Product Variations</p>
                <div>
                    <livewire:products.product-attribute />
                </div>
                {{ collect($productAttributes)->toJson() }}
            </div>
        </div>
    </div>
</div>