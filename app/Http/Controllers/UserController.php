<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class UserController extends Controller
{
    public function LoginPage(){
        return Inertia::render('LoginPage');
    }
    public function RegistrationPage(){
        return Inertia::render('RegistrationPage');
    }
    public function ResetPasswordPage(){
        return Inertia::render('ResetPasswordPage');
    }
    public function SendOTPPage(){
        return Inertia::render('SendOTPPage');
    }
    public function VerifyOTPPage(){
        return Inertia::render('VerifyOTPPage');
    }

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
            $data=['message'=>'Registration Successful','status'=>true,'error'=>''];
            return redirect()->route('LoginPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Registration Fail','status'=>true,'error'=>$e->getMessage()];
            return redirect()->route('RegistrationPage')->with($data);;
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
        $email=$request->input('email');
        $otp=rand(1000,9999);
        $count=User::where('email','',$email)->count();
        if($count!==null){
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email','=',$email)->update(['otp'=>$otp]);
            return response()->json([
                'status'=>'success',
                'message'=>"4 digit $otp"
            ],200);
        }
        else
        {
            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorized'
            ],401);
        }
    }
    function VerifyOTP(Request $request){
        $email=$request->input('email');
        $otp=$request->input('otp');
        $count=User::where('email','=',$email)->where('otp','=',$otp)->count();
        if($count!==null){
            User::where('email','=',$email)->update(['otp'=>'0']);
            $token=JWTToken::CreateTokenForSetPassword($email);
            return response()->json([
                'status'=>'success',
                'message'=>'OTP Verify Successful',
                'token'=>$token
            ],200)->cookie('token',$token,time()+60*24*30);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorized'
            ],400);
        }
    }
    function ResetPassword(Request $request){
       try{
        $email=$request->header('email');
        $password=$request->input('password');
        User::where('email','=',$email)->update(['password'=>$password]);
        return response()->json([
            'status'=>'success',
            'message'=>'Password Reset successful'
        ],200);
       }catch(Exception $e){
        return response()->json([
            'status'=>'failed',
            'message'=>'Unauthorized'
        ],400);
       }
    }
    function UserProfile(Request $request){
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return response()->json([
            'status'=>'success',
            'message'=>'Request Successful',
            'data'=>$user
        ],200);
    }
    public function UserUpdate(Request $request){

        try{
            $email=$request->header('email');
            $firstName=$request->input('firstName');
            $lastName=$request->input('lastName');
            $mobile=$request->input('mobile');
            $password=$request->input('password');
            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'mobile'=>$mobile,
                'password'=>$password
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'Request Successful',
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ],400);
        }
    }
}
