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
        $products = Product::whereIn('category_id', $categories)->latest()->paginate(30);

        return new ProductCollection($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
