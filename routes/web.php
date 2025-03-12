<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
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

//Customer
Route::post('/create-customer',[CustomerController::class,'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/list-customer',[CustomerController::class,'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-customer',[CustomerController::class,'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-customer',[CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-by-id',[CustomerController::class,'CustomerById'])->middleware(TokenVerificationMiddleware::class);

//Product
Route::post('/create-product',[ProductController::class,'ProductCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/list-product',[ProductController::class,'ProductList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-product',[ProductController::class,'ProductUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-product',[ProductController::class,'ProductDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-by-id',[ProductController::class,'ProductById'])->middleware(TokenVerificationMiddleware::class);

//Invoice
Route::post('/create-invoice',[InvoiceController::class,'InvoiceCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/select-invoice',[InvoiceController::class,'InvoiceSelect'])->middleware(TokenVerificationMiddleware::class);
Route::post('/details-invoice',[InvoiceController::class,'InvoiceDetails'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-invoice',[InvoiceController::class,'InvoiceDelete'])->middleware(TokenVerificationMiddleware::class);
