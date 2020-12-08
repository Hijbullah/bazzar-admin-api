
<tr>
    <td class="border-t px-6 py-2">

        @for ($i = 0; $i < $category->depth; $i++)
            {{ '-' }} 
        @endfor

        {{ $category->name }}
    </td>
    <td class="text-right border-t px-6 py-2">
        <button @click.prevent="sayHello('{{ route('categories.destroy', $category->id) }}')" title="Delete" class="inline-flex items-center text-red-500 hover:text-red-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
       
    </td>
</tr>

@if($category->children)
    @each('pages.categories.children', $category->children, 'category')
@endif
