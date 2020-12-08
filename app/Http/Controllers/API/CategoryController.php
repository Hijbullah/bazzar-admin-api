<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get()->toTree();
        return response()->json($categories);
    }

    public function getProducts(Category $category)
    {
        $categories = $category->descendants()->pluck('id');
        $categories[] = $category->getKey();
        $products = Product::whereIn('category_id', $categories)->get();
        return response()->json($products);
    }

    public function getproduct(Product $product)
    {
        return response()->json($product);
    }
}
