<?php

namespace App\Http\Controllers;

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

    }
    function UserLogout(){

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
