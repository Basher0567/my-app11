<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\TokenVerificationAPIMiddleware;

Route::post('/user-registration',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('UserLogin');
Route::get('/logout',[UserController::class,'UserLogout'])->name('UserLogout');
Route::post('/send-otp',[UserController::class,'SendOTPCode'])->name('SendOTPCode');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware(TokenVerificationAPIMiddleware::class);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/user-update',[UserController::class,'UserUpdate'])->middleware(TokenVerificationAPIMiddleware::class);


//Category
Route::post('/create-category',[CategoryController::class,'CategoryCreate'])->middleware(TokenVerificationAPIMiddleware::class);
Route::get('/create-list',[CategoryController::class,'CategoryList'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/delete-category',[CategoryController::class,'CategoryDelete'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/category-by-id',[CategoryController::class,'CategoryById'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/update-category',[CategoryController::class,'CategoryUpdate'])->middleware(TokenVerificationAPIMiddleware::class);


//Customer
Route::post('/create-customer',[CustomerController::class,'CustomerCreate'])->middleware(TokenVerificationAPIMiddleware::class);
Route::get('/list-customer',[CustomerController::class,'CustomerList'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/delete-customer',[CustomerController::class,'CustomerDelete'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/update-customer',[CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationAPIMiddleware::class);
Route::post('/customer-by-id',[CustomerController::class,'CustomerById'])->middleware(TokenVerificationAPIMiddleware::class);
