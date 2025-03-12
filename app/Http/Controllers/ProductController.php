<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductCreate(Request $request){
        $user_id=$request->header('id');
        Product::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'category_id'=>$request->input('category_id'),
            'user_id'=>$user_id
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Product add successfully'
        ]);
    }
    public function ProductList(Request $request){
        $user_id=$request->header('id');
        return Product::where('user_id',$user_id)->get();
    }
    public function ProductDelete(Request $request){
        $product_id=$request->input('id');
        $user_id=$request->header('id');
        Product::where('id',$product_id)->where('user_id',$user_id)->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Product Delete successfully'
        ]);
    }
    public function ProductUpdate(Request $request){
        $product_id=$request->input('id');
        $user_id=$request->header('id');
        Product::where('id',$product_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'category_id'=>$request->input('category_id')
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Product Update successfully'
        ]);
    }
    public function ProductById(Request $request){
        $product_id=$request->input('id');
        $user_id=$request->header('id');
        return  Product::where('id',$product_id)->where('user_id',$user_id)->first();
    }
}
