<?php

namespace App\Http\Livewire\Attributes;

use Livewire\Component;
use App\Models\Attribute;

class Index extends Component
{
    public $name;

    protected $rules = [
        'name' => ['required', 'string', 'unique:attributes'],
    ];

    public function addAttribute()
    {
        $data = $this->validate();

        Attribute::create($data);

        $this->reset();
    }

    public function deleteAttribute($id)
    {
        Attribute::destroy($id);
    }

    public function render()
    {
        return view('livewire.attributes.index', [
            'attributes' => Attribute::with('terms:id,name,attribute_id')->latest()->get()
        ]);
    }
}
