<div class="relative">
    <div class="absolute right-0 -top-8">
        {{-- <p>Product Attributes</p> --}}
        <div wire:loading wire:target="addAttribute, cancelAttributeSelection, removeAttribute">
            <svg class="animate-spin h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <div wire:dirty wire:target="attributeId">
            <svg class="animate-spin h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
    <div class="mt-3">
        <div class="w-full flex items-center space-x-2">
            <select wire:model="attributeId" class="w-full px-2 py-1 text-gray-800 border border-gray-200 focus:outline-none focus:border-blue-500 cursor-pointer">
                <option disabled value="null">
                    {{ count($selectedAttributIds) ? 'Select Another' : 'Select a Attribute' }}
                </option>
                @foreach ($allAttributes as $attribute)
                    <option value="{{ $attribute['id'] }}"  @if(in_array($attribute['id'], $selectedAttributIds)) disabled @endif>{{ $attribute['name'] }}</option>
                @endforeach
            </select>
        </div>
       
    </div>
    
    @if($selectedAttribute)
        <div class="mt-2 px-3 py-4 space-y-3 bg-white overflow-auto">
            <div class="flex justify-between items-center">
                <p>{{ $selectedAttribute['name'] }}</p>
                <div class="flex">
                    <button wire:click.prevent="addAttribute" class="text-xs font-semibold text-gray-800 uppercase tracking-wider hover:underline focus:outline-none">Add</button>
                    <button wire:click.prevent="cancelAttributeSelection" class="ml-2 text-xs text-gray-800 uppercase tracking-wider hover:underline focus:outline-none">Cancel</button>
                </div>
            </div>

            <div class="mt-2 ml-5 space-y-2">
                @foreach ($selectedAttribute['terms'] as $term)
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input wire:model.defer="selectedTerms" value="{{ $term['id'] }}" id="attribute_terms_{{ $term['id'] }}" type="checkbox" class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="attribute_terms_{{ $term['id'] }}" class="font-medium text-gray-700">{{ $term['name'] }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($productAttributes))
        <div class="h-96 mt-2 px-5 py-5 space-y-5 bg-white border-2 border-gray-200 rounded overflow-auto">
            @foreach ($productAttributes as $attribute)
                <div>
                    <div class="flex justify-between items-center">
                        <p class="font-semibold">{{ $attribute['name'] }}</p>
                        <button wire:click.prevent="removeAttribute('{{ $loop->index }}')" class="text-xs text-gray-800 uppercase tracking-wider hover:underline focus:outline-none">Remove</button>
                    </div>
        
                    <div class="mt-5 space-y-2">
                        @foreach ($attribute['terms'] as $term)
                            <div class="flex justify-between items-center py-2 px-4 bg-gray-50">
                                <p class="w-1/3 text-sm">{{ $term['name'] }}</p>
                                
                                <div x-data class="relative h-14 w-14">
                                    <div class="absolute inset-0" wire:loading wire:target="productAttributes.{{ $loop->parent->index }}.terms.{{ $loop->index }}.image">
                                        <div class="h-full w-full flex justify-center items-center">
                                            <svg class="animate-spin h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @if ($productAttributes[$loop->parent->index]['terms'][$loop->index]['image'])
                                        <img class="h-full w-full object-cover" src="{{ $productAttributes[$loop->parent->index]['terms'][$loop->index]['image']->temporaryUrl() }}">
                                    @else 
                                        <img x-on:click.prevent="$refs.fileUploadInput_{{ $term['id'] }}.click()" class="h-full w-full object-cover cursor-pointer" src="https://via.placeholder.com/56?text=image" alt="image">
                                    @endif

                                    <input x-ref="fileUploadInput_{{ $term['id'] }}" class="hidden" type="file" wire:model="productAttributes.{{ $loop->parent->index }}.terms.{{ $loop->index }}.image">
                                </div>

                                <input wire:model.lazy="productAttributes.{{ $loop->parent->index }}.terms.{{ $loop->index }}.quantity" type="number" min="0" placeholder="Qty" class="appearance-none h-8 w-20 px-2 py-1 text-sm text-gray-800 border-1 border-gray-200 focus:outline-none focus:border-blue-500">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>