<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function ProductPage(Request $request){
        $user_id=$request->header('user_id');
        $list= Product::where('user_id',$user_id)->get();
        return Inertia::render('ProductPage',['list'=>$list]);
    }
    public function ProductSavePage(Request $request){
        $product_id=$request->id;
        $user_id=$request->header('user_id');
        $list=Product::where('id',$product_id)->where('user_id',$user_id)->first();
        return Inertia::render('ProductSavePage',['list'=>$list]);
    }
    public function ProductCreate(Request $request){
        try{

            $user_id=$request->header('user_id');
            //dd($user_id);
            Product::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'category_id'=>$request->input('category_id'),
            'user_id'=>$user_id
            ]);
            $data=['message'=>'Product Created Successful','status'=>true,'error'=>''];
            return redirect()->route('ProductPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Product does not Create Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('ProductPage')->with($data);
        }
        /*return response()->json([
            'status'=>'success',
            'message'=>'Product add successfully'
        ]);*/
    }
    public function ProductList(Request $request){
        $user_id=$request->header('id');
        return Product::where('user_id',$user_id)->get();
    }
    public function ProductDelete(Request $request){
       try{
        $product_id=$request->id;
        $user_id=$request->header('user_id');
        Product::where('id',$product_id)->where('user_id',$user_id)->delete();
        $data=['message'=>'Delete Successful','status'=>true,'error'=>''];
        return redirect()->route('ProductPage')->with($data);
       }catch(Exception $e){
        $data=['message'=>'Delete not Successful','status'=>false,'error'=>$e->getMessage()];
        return redirect()->route('ProductPage')->with($data);
       }
    }
    public function ProductUpdate(Request $request){
        try{
            $product_id=$request->input('id');
            $user_id=$request->header('user_id');
            Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'category_id'=>$request->input('category_id')
            ]);
            $data=['message'=>'Product Update Successful','status'=>true,'error'=>''];
            return redirect()->route('ProductPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Product Update not Successful','status'=>false,'error'=>$e->getMessage()];
        return redirect()->route('ProductPage')->with($data);
        }
        /*return response()->json([
            'status'=>'success',
            'message'=>'Product Update successfully'
        ]);*/
    }
    public function ProductById(Request $request){
        $product_id=$request->input('id');
        $user_id=$request->header('id');
        return  Product::where('id',$product_id)->where('user_id',$user_id)->first();
    }
}
