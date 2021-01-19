
<div class="flex items-center">
    <input
        wire:model.defer="category_id" 
        value="{{ $category->id }}"
        name="category_id"
        id="category_{{ $category->slug }}" 
        type="radio" class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">

    <label for="category_{{ $category->slug }}" class="ml-3 block text-gray-700">
        @for ($i = 0; $i < $category->depth; $i++)
        {{ '-' }} 
        @endfor
        {{ $category->name }}
    </label>
</div>

@if($category->children)
    @each('livewire.products.category-child', $category->children, 'category')
@endif