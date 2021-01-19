<div x-data>
    <p class="mb-3">Product Images <span class="ml-2 font-semibold">({{ count($images) }})</span></p>
        
    <div class="relative bg-white border-2 border-gray-200 rounded">
        <div class="w-full p-2">
            @forelse ($images as $image)
                <div class="relative inline-block h-32 w-32 border border-gray-200 overflow-hidden">
                    <button 
                        wire:click.prevent="removeImage({{ $loop->index }})" 
                        type="button" class="absolute right-1 top-1 inline-flex items-center text-xl text-red-600 font-bold"
                    >
                        <svg class="w-5 h-5 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <img class="h-full w-full object-cover" src="{{ $image->temporaryUrl() }}" alt="product iamge">
                </div>
            @empty
                <div class="w-full h-32 flex justify-center items-center">
                    <p>Upload at least one Images of products</p>
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

    @error('image')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    {{-- @if(count($images) < 3) --}}
        <div class="py-3">
            <button wire:loading.attr="disabled" wire:target="image" x-on:click.prevent="$refs.fileUploadInput.click()" class="inline-flex items-center border-b-2 border-blue-500 hover:text-blue-500 focus:outline-none">Upload Image</button>
        </div>
    {{-- @endif --}}
    <input type="file" wire:model="image" x-ref="fileUploadInput" class="hidden">
</div>
