<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;
Route::post('/user-registration',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('UserLogin');
Route::get('/logout',[UserController::class,'UserLogout'])->name('UserLogout');
Route::post('/send-otp',[UserController::class,'SendOTPCode'])->name('SendOTPCode');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
