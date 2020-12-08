<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public $category;
    public $name;
    public $productUrl;
    public $price;
    public $discount;
    public $quantity;
    public $shortDescription;
    public $description;
    public $status = true;

    public $images =  [];
    public $image;

    protected $rules = [
        'category' => ['required', 'numeric'],
        'name' => ['required', 'string', 'max:255'],
        'productUrl' => ['required', 'string', 'max:100'],
        'shortDescription' => ['required', 'string', 'max:2000'],
        'description' => ['nullable', 'string'],
        'price' => ['nullable', 'numeric', 'min:1'],
        'discount' => ['nullable', 'numeric'],
        'quantity' => ['nullable', 'numeric', 'min:1'],
        'images' => ['required'],
    ];

    protected $messages = [
        'images.required' => 'Atleast one images is required.',
    ];
    
    public function updatedName($value)
    {
        $this->productUrl = preg_replace('/\s+/u', '-', trim(Str::of($value)->limit(100, ' ')->lower()));
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:jpg,jpeg|max:1024', // 1MB Max
        ]);

        array_push($this->images, $this->image);
        $this->image = null;
    }

    public function removeImage($index) 
    {
        array_splice($this->images, $index, 1);
    }
            
    
    public function saveProduct()
    {
        $data = $this->validate();

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




    public function render()
    {
        return view('livewire.products.create', [
            'categories' => Category::withDepth()->get()->toTree()
        ]);
    }
}
