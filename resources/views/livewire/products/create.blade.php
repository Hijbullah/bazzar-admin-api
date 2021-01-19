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
            <form wire:submit.prevent="saveProduct">
                <div class="mb-5">
                    <label for="name" class="block text-sm mb-2">Product Name</label>
                    <input type="text" wire:model.lazy="name" id="name" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Product Name">
                    
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
                <div x-data class="mb-3">
                    <p class="mb-3">Product Images</p>
        
                    <div class="relative bg-white border-2 border-gray-200 rounded">
                        <div class="w-full flex items-center space-x-2 p-2">
                            @forelse ($images as $image)
                                <div class="relative h-56 w-1/4 border-2 border-gray-200 overflow-hidden">
                                    <button wire:click.prevent="removeImage({{ $loop->index }})" type="button" class="absolute right-3 top-2 inline-flex items-center text-xl text-red-600 font-bold">X</button>
                                    <img class="h-full w-full object-cover" src="{{ $image->temporaryUrl() }}" alt="product iamge">
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
        
                    @if(count($images) <= 4)
                        <div class="py-3">
                            <button wire:loading.attr="disabled" wire:target="image" x-on:click.prevent="$refs.fileUploadInput.click()" class="inline-flex items-center border-b-2 border-blue-500 hover:text-blue-500 focus:outline-none">Upload Image</button>
                        </div>
                    @endif
                    <input type="file" wire:model="image" x-ref="fileUploadInput" class="hidden">
                </div>
                <div class="flex items-center">
                    <button type="submit" class="mr-3 px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-500 focus:outline-none">
                        Save Product
                    </button>
        
                    <a href="{{ route('categories.index') }}" class="px-3 py-2 bg-red-700 text-white rounded hover:bg-red-500 focus:outline-none">
                        Go Back
                    </a>
        
                    <div wire:loading wire:target="saveProduct">
                        <p class="ml-3 text-indigo-600 font-semibold">Saving Product... please wait...</p> 
                    </div>
                    
                    @if($errors->any())
                        <p class="ml-3 text-red-600 font-semibold">Error! Please Check the inputs.</p> 
                    @endif
                </div>
            </form>
        </div>
        <div class="w-1/3">
            <div class="mb-5">
                <p>Product Category</p>
    
                <div class="w-full h-64 mt-2 px-3 py-4 space-y-2 bg-white overflow-auto">
                    @each('includes.category-child', $categories, 'category')
                </div>
                  
                @error('category')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <p>Pricing & Quantity</p>
                <div class="mt-2 px-3 py-4 space-y-3 bg-white">
                    <div>
                        <input type="number" wire:model.lazy="price" id="price" min="0" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Price">
                        
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="number" wire:model.lazy="discount" id="discount" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Discount ex. 100">
                        
                        @error('discount')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="number" wire:model.lazy="quantity" id="quantity" min="0" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Quantity">
                        
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <div class="flex items-center">
                    <p>Product Attributes</p>
                    <div class="flex items-center h-5 ml-4">
                        <input type="checkbox" class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                </div>
                {{-- @if($hasAttribute) --}}
                    <div class="h-64 mt-2 px-3 py-4 space-y-3 bg-white overflow-auto">
                        @foreach ($attributes as $attribute)
                            <div>
                                <p>{{ $attribute->name }}</p>
                        
                                <div class="mt-2 ml-5 space-y-2">
                                    @foreach ($attribute->terms as $term)
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="attribute_terms_{{ $term->id }}" name="comments" type="checkbox" class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="attribute_terms_{{ $term->id }}" class="font-medium text-gray-700">{{ $term->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>    
                        @endforeach
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>

