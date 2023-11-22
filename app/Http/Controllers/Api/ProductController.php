<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response(['success'=>true , 'data'=>ProductResource::collection($products)]);
    }

    public function showByCategory($categoryName)
    {
        $products = Category::where('name', 'like' ,'%'. $categoryName .'%')->first()->products;
        return response(['success'=>true , 'data'=>ProductResource::collection($products)]);
    }

    public function addToCart(CartRequest $request)
    {
       $validation = $request->validated();
       $validation['user_id'] = Auth::id();
       $cart = Cart::create($validation);
       return response(['success'=>true , 'data'=>$cart]);
    }
}
