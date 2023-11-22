<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        $validation = $request->validated();
        $validation['image'] = $request->image->getClientOriginalName();
        $product = Product::create($validation);
        
        $request->image->move(public_path('images/products') , $request->image->getClientOriginalName());

        foreach((array)$request->images as $image)
        {
            $name = $image->getClientOriginalName();
            $image->move(public_path('images/productImages'), $name);

            ProductImage::create([
                'image' => $name,
                'product_id' => $product->id
            ]);
        } 

        DB::commit();
        return redirect()->route('products.index')->with(['success'=>"you have successfully created item"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete_image($id)
    {
        $image = ProductImage::find($id);
        $one = explode('//' , trim($image->image));
        $two = explode('/' , trim($one[1]));
        $path = $two[1].'/'.$two[2].'/'.$two[3];
        unlink(public_path($path));
        $image->delete();
        return back()->with(['success'=>"you have successfully deleted item"]);
    }
}
