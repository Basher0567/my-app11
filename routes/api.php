<?php

use App\Http\Middleware\TokenVerificationAPIMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user-registration',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('UserLogin');
Route::get('/logout',[UserController::class,'UserLogout'])->name('UserLogout');
Route::post('/send-otp',[UserController::class,'SendOTPCode'])->name('SendOTPCode');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware(TokenVerificationAPIMiddleware::class);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/user-update',[UserController::class,'UserUpdate'])->middleware(TokenVerificationAPIMiddleware::class);


