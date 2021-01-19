<div class="flex flex-col">
    <div class="w-full flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Categories</h2>
        <div wire:loading>
            <svg class="animate-spin h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    @if (session()->has('message'))
        <template  
            x-data="{show: true}" 
            x-if="show"
        >
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
                <span @click.prevent="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </template>
    @endif

    <div class="flex mt-6">
        <div class="w-1/3">
            <p class="mb-5 text-sm font-semibold">Add new Category</p>
            
            <form wire:submit.prevent="saveCategory">
                <div class="mb-5">
                    <label for="name" class="block text-sm mb-2">Name</label>
                    <input type="text" 
                        wire:model.defer="name" 
                        id="name" class="block px-2 py-2 w-full text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-blue-500" 
                        placeholder="category Name">
                    
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="parent" class="block text-sm mb-2">Parent Category</label>
    
                    <select wire:model.defer="parent" id="parent" class="block px-2 py-1 w-2/3 text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-blue-500">
                        <option selected value="0">No Parent</option>
                        @each('livewire.categories.category-child-select', $categories, 'category')
                    </select>

                    @error('parent')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data class="mb-5">
                    <label for="name" class="block text-sm mb-2">Image</label>
                    <div class="h-36 w-36">
                        @if($image)
                            <img class="w-full h-full object-cover" src="{{ $image->temporaryUrl() }}" alt="image">
                        @else 
                            <div>
                                <img x-on:click.prevent.self="$refs.fileUploadInput.click()" class="w-full h-full object-cover cursor-pointer" src="https://via.placeholder.com/150?text=Image" alt="image">
                            </div>
                        @endif
                    </div>

                    <input wire:model.defer="image" type="file" class="hidden" x-ref="fileUploadInput">
                    
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center">
                    <button type="submit" class="mr-3 px-3 py-2 bg-blue-700 text-sm text-white rounded hover:bg-blue-500 focus:outline-none">
                        Save category
                    </button>
                </div>
            </form>
        </div>
        <div class="w-2/3">
            <div class="ml-7 p-4 bg-white">
                <table class="w-full whitespace-no-wrap">
                    <tr class="text-gray-800">
                        <td class="px-6 py-4 font-semibold">Image</td>
                        <td class="px-6 py-4 font-semibold">Name</td>
                        <td class="w-48 text-right px-6 py-4 font-semibold">Action</td>
                    </tr>
                    @each('livewire.categories.category-child', $categories, 'category', 'livewire.categories.category-child-empty')
                </table>
            </div>
        </div>
    </div>
</div>