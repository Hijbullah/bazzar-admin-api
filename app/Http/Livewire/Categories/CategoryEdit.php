<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Traits\ImageUpload;
use Livewire\WithFileUploads;

class CategoryEdit extends Component
{
    use WithFileUploads, ImageUpload;
    
    public $category;

    public $image;
    
    protected $rules = [
        'category.name' => ['required', 'string', 'max:255', 'min:2'],
        'category.parent_id' => [],
        'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg', 'max:1024'], // 1MB Max
    ];

    public function updateCategory()
    {
        $this->validate();

        if($this->image)
        {
            $path = $this->uploadImage($this->image, 'categories', 150, 150);
            
            if($this->category->image) 
            {
                $this->deleteImage($this->category->image);
            }
            $this->category->image = $path;
        }

        $this->category->save();

        session()->flash('message', 'Category successfully updated.');
        return redirect()->route('categories.index');
    }

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.categories.category-edit', [
            'categories' => Category::withDepth()->whereNotDescendantOf($this->category)->latest()->get()->toTree()
        ])
            ->extends('layouts.app')
            ->section('page-content');
    }
}
