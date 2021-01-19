<tr>
    <td class="border-t px-6 py-2">
        <div class="h-10 w-10">
            <img src="{{ $category->image ? Storage::url($category->image) : 'https://via.placeholder.com/150?text=Image"' }}" alt="image">
        </div>
    </td>

    <td class="border-t px-6 py-2">
        @for ($i = 0; $i < $category->depth; $i++)
        {{ '-' }} 
        @endfor
       {{ $category->name }}
    </td>
   
    <td class="text-right border-t px-6 py-2">
        <a href="{{ route('categories.edit', $category->slug) }}" title="Edit Category" class="inline-flex items-center text-green-500 hover:text-green-400">
            <svg class="w-5 h-5 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>
        <button wire:click.prevent="deleteCategory('{{ $category->id }}')" title="Delete" class="inline-flex items-center text-red-500 hover:text-red-700 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    </td>
</tr>

@if($category->children)
    @each('livewire.categories.category-child', $category->children, 'category')
@endif
