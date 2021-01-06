<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::with('ancestors')->get()->toTree();
        // return $categories;
        // $categories =Category::with('descendants')->get();
        return CategoryResource::collection($categories);
        // return response()->json($categories);
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

    public function checkQuantity($id)
    {
        $quantity = Product::where('id', $id)->select('id', 'quantity')->first()->quantity;
        return response()->json($quantity);
    }
}
