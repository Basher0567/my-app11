<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function CustomerPage(Request $request){
        $user_id=$request->header('user_id');
        $list= Customer::where('user_id',$user_id)->get();
        return Inertia::render('CustomerPage',['list'=>$list]);
    }
    public function CustomerSavePage(){
        return Inertia::render('CustomerSavePage');
    }
    public function CustomerCreate(Request $request){
      try{
        $user_id=$request->header('user_id');
        Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'user_id'=>$user_id
        ]);
        $data =['message'=>'Create Successful','status'=>true,'error'=>''];
        return  redirect()->route('CustomerSavePage')->with($data);
      }catch(Exception $e){
        $data =['message'=>'Create not Successful','status'=>false,'error'=>$e->getMessage()];
        return  redirect()->route('CustomerSavePage')->with($data);
      }
    }
    public function CustomerList(Request $request){
        $user_id=$request->header('id');
        return Customer::where('user_id',$user_id)->get();
    }
    public function CustomerDelete(Request $request){
        try{
            $customer_id=$request->id;
            $user_id=$request->header('user_id');
            Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
            $data=['message'=>'Delete Successful','status'=>true,'error'=>''];
            return redirect()->route('CustomerPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Delete UnSuccessful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('CustomerPage')->with($data);
        }
    }
    public function CustomerUpdate(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        Customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile')
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Customer Update Successful'
        ]);
    }
    public function CustomerById(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->first();
    }

}
