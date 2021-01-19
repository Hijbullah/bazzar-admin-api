<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class CategoryIndex extends Component
{
    use WithFileUploads, ImageUpload;

    public $name;
    public $parent = 0;
    public $image;

    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'min:2'],
        'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg', 'max:1024'], // 1MB Max
    ];
    
    public function saveCategory()
    {
        $this->validate();

        $slug = Str::slug($this->name);

        $categoryCount = Category::where('name', $slug)->count();

        if($categoryCount)
        {
            $slug = $slug . '-' . $categoryCount;
        }

        if($this->image)
        {
            $path = $this->uploadImage($this->image, 'categories', 150, 150);
        }

        $data = [
            'name' => $this->name,
            'slug' => $slug,
            'image' => $path ?? null
        ];

        if($this->parent)
        {
            $parent = Category::find($this->parent);
            Category::create($data, $parent);
        }else {
            Category::create($data);
        }

        session()->flash('message', 'Category successfully added.');
        $this->reset();
    }

    public function deleteCategory(Category $category)
    {   
        $category->delete();
        $this->deleteImage($category->image);

        session()->flash('message', 'Category successfully deleted.');
    }

   
    public function render()
    {
        return view('livewire.categories.category-index', [
            'categories' => Category::withDepth()->latest()->get()->toTree()
        ])
        ->extends('layouts.app')
        ->section('page-content');
    }
}
