@extends('layouts.app')

@section('page-content')
    <nav class="text-sm font-semibold mb-6" aria-label="Breadcrumb">
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

    <div class="flex mb-20">
        page content
    </div>
@endsection



@forelse ($categories as $category)
                    <tr>
                        <td class="border-t px-6 py-2">
                            {{ $category->name }}
                        </td>
                       
                        {{-- <td class="border-t px-6 py-2">
                            hijbullah@app.com
                        </td>
                        <td class="border-t px-6 py-2">
                            created_at
                        </td>
                        <td class="border-t px-6 py-2">
                        ffff
                        </td> --}}
                        <td class="border-t px-6 py-2">
                            {{-- <button 
                                v-if="student.is_approved"
                                @click.prevent="approvedStudent(student.id, student.is_approved)"
                                class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs uppercase tracking-widest rounded hover:bg-red-500 focus:outline-none"
                            >
                                unapprove
                            </button>
                            <button 
                                v-else
                                @click.prevent="approvedStudent(student.id, student.is_approved)"
                                class="inline-flex items-center px-2 py-1 bg-gray-900 text-white text-xs uppercase tracking-widest rounded hover:bg-gray-700 focus:outline-none"
                            >
                                approve
                            </button> --}}
                        </td>
                    </tr>
                    @if($category->children)
                        @include('pages.categories.children', ['categories' => $category->children])
                    @endif
                @empty
                    <tr>
                        <td class="border-t px-6 py-4" colspan="4">No students found.</td>
                    </tr>
                @endforelse



                 {{-- <div 
                    class="mb-5"
                    x-data="{
                        images: [
                            {
                                file: null,
                                previewUrl: 'https://dummyimage.com/800x800/f2eaf2/000'
                            }
                        ],
                        addMore() {
                            this.images.push({
                                file: null,
                                previewUrl: 'https://dummyimage.com/800x800/f2eaf2/000'
                            });
                        }
                    }" 
                >
                    <p class="mb-3">Product Images</p>

                    <div class="flex items-center space-x-2 p-5 bg-white">
                        <template x-for="(image, index) in images" :key="index">
                            <div class="h-56 w-1/4 border-2 border-gray-200 overflow-hidden">
                                <img class="h-full w-full object-cover" :src="image.previewUrl" alt="product iamge">
                                <p x-text="image"></p>
                            </div>
                        </template>

                        <button x-show="images.length < 4" @click.prevent="addMore">Add More</button>
                    </div>
                </div> --}}

                <template x-for="(image, index) in images" :key="index">
                    <div class="relative h-56 w-1/4 border-2 border-gray-200 overflow-hidden">
                        <button type="button" class="absolute right-3 top-2 inline-flex items-center text-xl text-red-600 font-bold">X</button>
                        {{-- <img x-show="image" class="h-full w-full object-cover" :src="image.previewUrl" alt="product iamge"> --}}
                        <img class="h-full w-full object-cover" :src="image.previewUrl" alt="product iamge">
                        <button @click.prevent="triggerUpload(index)" class="absolute left-1/2 transform -translate-x-1/2 bottom-4 inline-flex items-center border-b-2 border-blue-500 hover:text-blue-500 focus:outline-none">Upload</button>
                    </div>
                </template>


                x-data="{
                    images: @entangle('images'),
                    currentIndex: @entangle('currentIndex'),
                    addMore() {
                        this.images.push({
                            file: null,
                            previewUrl: 'https://dummyimage.com/800x800/f2eaf2/000'
                        });
                    },
                    triggerUpload(index) {
                        this.currentIndex = index;
                        this.$refs.fileUploadInput.click();
                    },
                    {{-- uploadImage(index) {
                        let file = this.$refs.fileUploadInput.files[0];
                        
                        @this.upload('image', file, (uploadedFilename) => {
                            // Success callback.
                            console.log(uploadedFilename);
                        }, () => {
                            // Error callback.
                        }, (event) => {
                            // Progress callback.
                            // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                        })
                    } --}}
                }" 


                <div class="mb-5">
                    <label for="images" class="block text-sm mb-2">Product Images</label>
                    <input type="file" id="images" name="images[]" multiple class="block px-2 py-2 w-full bg-white text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" />
                    
        
                    @error('images')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>



                <div>
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                          </svg>
                          Processing
                        </button>
                    </span>
                </div>


                <div class="w-1/3">
                    <label for="sku" class="block text-sm mb-2">Product SKU</label>
                    <input type="text" wire:model.lazy="sku" id="sku" class="block px-2 py-2 w-full text-gray-800 border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500" placeholder="Product Name">
                    
                    @error('sku')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>