<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    
    public $product;
    public $images;
    public $image;

    protected $rules = [
        'product.category_id' => ['required', 'numeric'],
        'product.name' => ['required', 'string', 'max:255'],
        'product.short_description' => ['required', 'string', 'max:2000'],
        'product.description' => ['nullable', 'string'],
        'product.sale_price' => ['required', 'numeric', 'min:1'],
        'product.discount' => ['nullable', 'numeric'],
        'product.quantity' => ['required', 'numeric', 'min:1'],
        'images' => ['required'],
    ];

    protected $messages = [
        'images.required' => 'Atleast one images is required.',
    ];

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:jpg,jpeg|max:1024', // 1MB Max
        ]);

        $path = $this->image->store('products');
        array_push($this->images, $path);
        DB::table('products')
              ->where('id', $this->product->id)
              ->update(['images' => $this->images]);

        $this->image = null;
    }

    public function removeImage($index)
    {
        $file = $this->images[$index];

        Storage::delete($file);
        array_splice($this->images, $index, 1);
        
        $id = DB::table('products')
            ->where('id', $this->product->id)
            ->update(['images' => $this->images]);
       
    }

    public function updateProduct()
    {
        $this->validate();
        $this->product->discount = $this->product->discount ? $this->product->discount : null;
        $this->product->price_show = $this->product->discount ? $this->product->sale_price - $this->product->discount : $this->product->sale_price;
        $this->product->save();

        session()->flash('status', 'Product successfully updated.');
        return redirect()->route('products.index');
    }

    public function mount()
    {
        $this->images = $this->product->images;
    }
    
    public function render()
    {
        return view('livewire.products.edit', [
            'categories' => Category::withDepth()->get()->toTree()
        ]);
    }
}
