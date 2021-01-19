<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImage extends Component
{
    use WithFileUploads;
    
    public $images =  [];
    public $image;

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB Max
        ]);

        array_push($this->images, $this->image);
        $this->image = null;
        $this->emitUp('imageUpdated', $this->images);
    }

    public function removeImage($index) 
    {
        array_splice($this->images, $index, 1);
        $this->emitUp('imageUpdated', $this->images);
    }

    public function render()
    {
        return view('livewire.products.product-image');
    }
}
