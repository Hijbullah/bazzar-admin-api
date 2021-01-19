<?php

namespace App\Http\Livewire\Products;


use Livewire\Component;
use App\Models\Attribute;
use Livewire\WithFileUploads;

class ProductAttribute extends Component
{
    use WithFileUploads;
    
    public $allAttributes;
    public $productAttributes = [];

    public $attributeId;
    public $selectedAttribute;
    public $selectedTerms = [];

    public $selectedAttributIds = [];
    public $productVariants = [];


    public function updatedAttributeId()
    {
        $this->selectedAttribute = collect($this->allAttributes)->where('id', $this->attributeId)->first();
    }

    public function updatedProductAttributes()
    {
        $this->emitUp('productAttributesUpdated', $this->productAttributes);
    }

    public function addAttribute()
    {
        if(empty($this->selectedTerms)) return;

        $productVariants = [
            [
                'attributes' => [
                   'color' => 'red', 
                    'size' => 'L'
                ],
                'quantity' => 1,
                'image' => 'image'
            ]
        ];

        $attribute = $this->selectedAttribute;
         
        $attribute['terms'] = array_values(collect($attribute['terms'])->filter(function($term) {
            return in_array($term['id'], $this->selectedTerms);
        })->toArray());
        
        // $this->emitUp('productAttributesUpdated', $attribute);
        $this->productAttributes[] = $attribute;
        $this->selectedAttributIds[] = $this->attributeId;
        $this->cancelAttributeSelection();

    }

    public function cancelAttributeSelection()
    {
        $this->selectedTerms = [];
        $this->attributeId = null;
        $this->selectedAttribute = null;
    }
    
    public function removeAttribute($index)
    {
        array_splice($this->productAttributes, $index, 1);
        array_splice($this->selectedAttributIds, $index, 1);
    }

    public function mount() {
        $this->allAttributes = Attribute::select('id', 'name')->with('terms:id,name,attribute_id')->get()->map(function($attribute) {
            return [
                'id' => $attribute->id,
                'name' => $attribute->name,
                'terms' => $attribute->terms->map(function($term) {
                    return [
                        'id' => $term->id,
                        'name' => $term->name,
                        'quantity' => null,
                        'image' => null
                    ];
                })
            ];
        });


        /*
            $productVariants = [
                [
                    attributes: [
                       'color' => 'red', 
                        'size' => 'L'
                    ],
                    'quantity' => 1,
                    'image' => image
                ]
            ]
        
        */
    }

    public function render()
    {
        return view('livewire.products.product-attribute');
    }
}
