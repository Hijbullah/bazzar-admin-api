<?php

namespace App\Http\Livewire\Attributes;

use Livewire\Component;
use App\Models\Attribute;
use App\Models\AttributeValue;

class TermsIndex extends Component
{
    public $attribute;
    public $name;

    protected $rules = [
        'name' => ['required', 'string', 'unique:attribute_values'],
    ];

    public function addAttributeTerm()
    {
        $data = $this->validate();

        $attributeTerm = new AttributeValue($data);

        $this->attribute->terms()->save($attributeTerm);

        $this->reset('name');
    }

    public function deleteAttributeTerm($id)
    {
        AttributeValue::destroy($id);
    }

    public function mount(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function render()
    {
        return view('livewire.attributes.terms-index', [
            'terms' => $this->attribute->terms()->select('id', 'name')->latest()->get()
        ])
        ->extends('layouts.app')
        ->section('page-content');
    }
}
