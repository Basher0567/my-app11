<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function UserRegistration(Request $request){
        //dd($request->all());
        try{

            $firstName=$request->input('firstName');
            $lastName=$request->input('lastName');
            $email=$request->input('email');
            $mobile=$request->input('mobile');
            $password=$request->input('password');
            User::create([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'email'=>$email,
                'mobile'=>$mobile,
                'password'=>$password
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'Registration Successful'
            ],201);
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ],401);
        }

    }
    function UserLogin(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $count=User::where('email','=',$email)->where('password','=',$password)->select('id')->first();
        if($count!==null){
            $token=JWTToken::CreateToken($request->input('email'),$count->id);
            return response()->json([
                'status'=>'success',
                'message'=>'Login Successful',
                'token'=>$token
            ],201)->cookie('token',$token,time()+60*24*30);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Login Failed'
            ],401);
        }

    }
    function UserLogout(){
        return redirect('/')->cookie('token','',-1);
    }
    function SendOTPCode(Request $request){

    }
    function VerifyOTP(Request $request){

    }
    function ResetPassword(Request $request){

    }
    function UserProfile(Request $request){

    }
    function UpdateProfile(Request $request){

    }
}
