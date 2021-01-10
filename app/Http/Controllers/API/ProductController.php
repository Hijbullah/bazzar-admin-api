<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        $categories = $category->descendants()->pluck('id');
        $categories[] = $category->getKey();
        $products = Product::whereIn('category_id', $categories)->withAvg('reviews', 'rating')->latest()->paginate(24);

        return new ProductCollection($products);
    }

    public function show($slug) // slug
    {
        return new ProductResource(Product::whereSlug($slug)->with('reviews')->withAvg('reviews', 'rating')->firstOrFail());
    }
}
