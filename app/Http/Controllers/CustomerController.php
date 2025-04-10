<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function CustomerPage(){
        return Inertia::render('CustomerPage');
    }
    public function CustomerCreate(Request $request){
        $user_id=$request->header('id');
         return Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'user_id'=>$user_id
        ]);
    }
    public function CustomerList(Request $request){
        $user_id=$request->header('id');
        return Customer::where('user_id',$user_id)->get();
    }
    public function CustomerDelete(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Customer Delete Successful'
        ]);
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
