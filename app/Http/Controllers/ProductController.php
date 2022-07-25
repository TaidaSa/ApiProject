<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $allProducts = Product::all();
        return $allProducts;
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'price'=>"required"
        ]);
        return Product::creat($request->all());
    }


    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'name' => "required",
            "price" => "required",
        ]);
        $product->update($request->all()); 
        return $product;
    }


    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
