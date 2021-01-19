<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class CreateProduct extends Component
{
    public $hasProductVariation = false;
    
    public $test;
    public $category_id;
    public $name;
    public $price;
    public $discount;
    public $quantity;
    public $shortDescription;
    public $description;
    public $status = true;
    public $productAttributes = [];

    public $images =  [];

    protected $listeners = ['imageUpdated', 'productAttributesUpdated'];


    protected $rules = [
        'category_id' => ['required', 'numeric'],
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price' => ['nullable', 'numeric', 'min:1'],
        'discount' => ['nullable', 'numeric'],
        'quantity' => ['nullable', 'numeric', 'min:1'],
        'images' => ['required'],
    ];

    protected $messages = [
        'category_id.required' => 'Category is required.',
        'images.required' => 'Atleast one image is required.',
    ];

    public function imageUpdated($images)
    {
        $this->images = $images;
    }
    
    public function productAttributesUpdated($productAttributes)
    {
        $this->productAttributes = $productAttributes;
    }
  
    public function saveProduct()
    {
        $data = $this->validate();

        dd($data);

        $imagesUrl = collect($this->images)->map->store('products');

        
        $product = Product::create([
            'category_id' => $this->category,
            'name' => $this->name,
            'slug' => $this->productUrl,
            'short_description' => $this->shortDescription,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'sale_price' => $this->price,
            'discount' => $this->discount,
            'price_show' => $this->discount ? $this->price - $this->discount : $this->price,
            'images' => $imagesUrl,
            'status' => $this->status,
        ]);

        session()->flash('status', 'Product successfully inserted.');
        return redirect()->route('products.index');
    }

    public function getCategoriesProperty()
    {
        return Category::withDepth()->get()->toTree();
    }

    // public function mount()
    // {
    //     $categories = Category::withDepth()->get();
    //     $this->allCategories = $categories;
    // }

    public function render()
    {
        return view('livewire.products.create-product')
            ->extends('layouts.app')
            ->section('page-content');
    }
}
