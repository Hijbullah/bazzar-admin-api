
<option value="{{ $category->id }}">
    @for ($i = 0; $i < $category->depth; $i++)
        {{ '-' }} 
    @endfor

    {{ $category->name }}
</option>

@if($category->children)
    @each('pages.products.category-child', $category->children, 'category')
@endif
