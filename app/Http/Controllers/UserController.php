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
            $data=['message'=>'Registration Fail','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('RegistrationPage')->with($data);;
        }

    }
    function UserLogin(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $count=User::where('email','=',$email)->where('password','=',$password)->select('id')->first();

        if($count!==null){
           $email=$request->input('email');
           $user_id=$count->id;

           $request->session()->put('email',$email);
           $request->session()->put('user_id',$user_id);

           $data=['message'=>'Login Successful','status'=>true,'error'=>''];
           return redirect()->route('DashboardPage')->with($data);

        }else{
            $data=['message'=>'Login Fail','status'=>false];
            return redirect()->route('LoginPage')->with($data);
        }

    }
    function UserLogout(Request $request){
        $request->session()->flush();
        return redirect()->route('LoginPage');
    }
    function SendOTPCode(Request $request){
        $email=$request->input('email');
        $otp=rand(1000,9999);
        $count=User::where('email','',$email)->count();

        if($count!==null){
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email','=',$email)->update(['otp'=>$otp]);
            $data=['message'=>'Send OTP Successful','status'=>true,'error'=>''];
            $request->session()->put('email',$email);
            return redirect()->route('VerifyOTPPage');
        }
        else
        {
            $data=['message'=>'Send OTP Fail','status'=>false,'error'=>''];
            return redirect()->route('SendOTPPage')->with($data);
        }
    }
    function VerifyOTP(Request $request){
        $email=$request->session()->get('email','default');
        $otp=$request->input('otp');
        $count=User::where('email','=',$email)->where('otp','=',$otp)->count();

        if($count!==null){
            User::where('email','=',$email)->update(['otp'=>'0']);
            $request->session()->put('otp_verify','yes');

            $data=['message'=>'Verify OTP Successful','status'=>true,'error'=>''];
            return redirect()->route('ResetPasswordPage')->with($data);

        }else{
            $data=['message'=>'Verify OTP Fail','status'=>false,'error'=>''];
            return redirect()->route('VerifyOTPPage')->with($data);
        }
    }
    function ResetPassword(Request $request){
       try{
        $email=$request->session()->get('email','default');
        $password=$request->input('password');
        $otp_verify=$request->session()->get('otp_verify','default');

        if($otp_verify==="yes")
        {
            User::where('email','=',$email)->update(['password'=>$password]);
        }

        $data=['message'=>'Password Reset Successful','status'=>true,'error'=>''];
        $request->session()->flush();
        return redirect()->route('LoginPage')->with($data);

       }catch(Exception $e){
        $data=['message'=>'Password Reset Fail','status'=>false,'error'=>$e->getMessage()];
        return redirect()->route('ResetPasswordPage')->with($data);
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
