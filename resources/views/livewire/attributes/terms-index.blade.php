<div class="flex flex-col">
    <div class="w-full flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 uppercase tracking-wider">Product {{ $attribute->name }}</h2>
        <div wire:loading>
            <svg class="animate-spin h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    @if (session()->has('status'))
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
            {{ $name }}
        </template>
    @endif


    <div class="flex mt-6">
        <div class="w-1/3">
            <p class="mb-5 text-sm font-semibold">Add new {{ $attribute->name }}</p>
            <form wire:submit.prevent="addAttributeTerm">
                <div class="mb-5">
                    <label for="name" class="block text-sm mb-2">Name</label>
                    <input type="text" 
                        wire:model.lazy="name" 
                        id="name" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" 
                        placeholder="{{ $attribute->name }} ...">
                    
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center">
                    <button type="submit" class="mr-3 px-3 py-2 bg-blue-700 text-sm text-white rounded hover:bg-blue-500 focus:outline-none">
                        Add new {{ $attribute->name }}
                    </button>

                    <a class="text-sm text-gray-800 hover:underline font-semibold uppercase tracking-wider" href="{{ route('attributes.index') }}">Go Back</a>

                   
                        {{-- <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:border-green-700 active:bg-green-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                          </svg>
                          Processing
                        </button> --}}
                     

                    {{-- <div wire:loading wire:target="addAttributeTerm">
                        <p class="ml-3 text-sm text-indigo-600">Saving... please wait...</p> 
                    </div> --}}
                </div>
            </form>
        </div>
        <div class="w-2/3">
            <div class="ml-7 p-4 bg-white">
                <table class="w-full whitespace-no-wrap">
                    <tr class="text-gray-800">
                        <td class="px-6 py-4 font-semibold">Name</td>
                        <td class="w-48 text-right px-6 py-4 font-semibold">Action</td>
                    </tr>
                    @forelse ($terms as $term)
                        <tr>
                            <td class="border-t px-6 py-2">{{ $term->name }}</td>
                            <td class="text-right border-t px-6 py-2">
                                <button wire:click.prevent="deleteAttributeTerm('{{ $term->id }}')" title="Delete" class="inline-flex items-center text-red-500 hover:text-red-700 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border-t px-6 py-8 text-center" colspan="6">No {{ $attribute->name }} found. Add some first</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>