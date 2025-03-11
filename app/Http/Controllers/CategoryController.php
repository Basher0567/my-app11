<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryList(Request $request){
        $user_id=$request->header('id');
        $categories = Category::where('id',$user_id)->get();
        return response()->json([
            'status'=>'success',
            'message'=>'New Category created Successful',
            'data'=>$categories
        ],200);
    }
    public function CategoryCreate(Request $request){
       try{
        $user_id=$request->header('id');
        // return $user_id;
        Category::create([
            'name'=>$request->input('name'),
            'user_id'=>$user_id
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'New Category created Successful'
        ],200);
       }catch(Exception $e){
        return response()->json([
            'status'=>'failed',
            'message'=>$e->getMessage()
        ],400);
       }
    }
    function CategoryDelete(Request $request){

    }
    function CategoryById(Request $request){

    }
    function CategoryUpdate(Request $request){

    }
}
