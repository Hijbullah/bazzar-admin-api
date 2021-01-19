<option value="{{ $category->id }}">
    @for ($i = 0; $i < $category->depth; $i++)
        {{ '-' }} 
    @endfor

    {{ $category->name }}
</option>

@if($category->children)
    @each('livewire.categories.category-child-select', $category->children, 'category')
@endif