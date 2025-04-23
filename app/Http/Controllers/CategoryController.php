<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function CategoryPage(Request $request){
        $user_id=$request->header('user_id');
        $list=Category::where('user_id',$user_id)->get();
        return Inertia::render('CategoryPage',['list'=>$list]);
    }
    public function CategorySavePage(){

        return Inertia::render('CategorySavePage');
    }
    public function CategoryList(Request $request){
        $user_id=$request->header('id');
        return Category::where('user_id',$user_id)->get();

    }
    public function CategoryCreate(Request $request){
       try{
        $user_id=$request->header('user_id');
        // return $user_id;
        Category::create([
            'name'=>$request->input('name'),
            'user_id'=>$user_id
        ]);
        $data =['message'=>'Create Successful','status'=>true,'error'=>''];
        return  redirect()->route('CategorySavePage')->with($data);
       }catch(Exception $e){
        $data =['message'=>'Create not Successful','status'=>false,'error'=>$e->getMessage()];
        return  redirect()->route('CategorySavePage')->with($data);
       }
    }
    function CategoryDelete(Request $request){
        try{
            $category_id=$request->id;
            $user_id=$request->header('user_id');
            Category::where('id',$category_id)->where('user_id',$user_id)->delete();
            $data=['message'=>'Delete Successful','status'=>true,'error'=>''];
            return redirect()->route('CategoryPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Delete UnSuccessful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('CategoryPage')->with($data);
        }

    }
    function CategoryById(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->first();
    }
    function CategoryUpdate(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        Category::where('id',$category_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name')
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Category Update Successful'
        ],200);
    }
}
