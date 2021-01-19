<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return view('pages.attributes.index');
    }

    public function attributeTerms(Attribute $attribute)
    {
        // return Attribute::with('terms:id,name')->get();
        return Attribute::with('terms:id,name')->get();

        return view('pages.attributes.terms', compact('attribute'));
    }
}
