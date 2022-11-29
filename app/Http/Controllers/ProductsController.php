<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function addProduct(StoreProduct $request){
        $validated = $request->validated();
        Products::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        return response()->json([
            'message' => 'Product added successfully.'
        ]);
    }

    public function getProducts(){
        return new ProductResource(Products::paginate(15));
    }

    public function updateProduct(Request $request, $id){
        Products::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return response()->json(['success'=>'Product Updated Successfully!']);
    }

    public function deleteProduct(Request $request){
        $product = Products::where('id',$request->id)->first();
        Products::where('id',$request->id)->delete();
        return response()->json(['success'=> $product->name.' delete Successfully!']);
    }
}
