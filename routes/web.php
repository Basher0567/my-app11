<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

//user
Route::post('/user-registration',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('UserLogin');
Route::get('/logout',[UserController::class,'UserLogout'])->name('UserLogout');
Route::post('/send-otp',[UserController::class,'SendOTPCode'])->name('SendOTPCode');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware(TokenVerificationMiddleware::class);
Route::post('/user-update',[UserController::class,'UserUpdate'])->middleware(TokenVerificationMiddleware::class);

//Category
Route::post('/create-category',[CategoryController::class,'CategoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/create-list',[CategoryController::class,'CategoryList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-category',[CategoryController::class,'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-by-id',[CategoryController::class,'CategoryById'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-category',[CategoryController::class,'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);

