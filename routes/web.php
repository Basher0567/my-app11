<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SessionAuthenticate;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

//Laravel Vue Page Routing for user
Route::get('/',[HomeController::class,'HomePage'])->name('HomePage');
Route::get('/LoginPage',[UserController::class,'LoginPage'])->name('LoginPage');
Route::get('/RegistrationPage',[UserController::class,'RegistrationPage'])->name('RegistrationPage');
Route::get('/SendOTPPage',[UserController::class,'SendOTPPage'])->name('SendOTPPage');
Route::get('/VerifyOTPPage',[UserController::class,'VerifyOTPPage'])->name('VerifyOTPPage');
Route::get('/ResetPasswordPage',[UserController::class,'ResetPasswordPage'])->name('ResetPasswordPage');


//Laravel Vue Page Routing for user Dashboard
Route::get('/DashboardPage',[DashboardController::class,'DashboardPage'])->middleware(SessionAuthenticate::class)->name('DashboardPage');
Route::get('/CategoryPage',[CategoryController::class,'CategoryPage'])->name('CategoryPage')->middleware(SessionAuthenticate::class);
Route::get('/CustomerPage',[CustomerController::class,'CustomerPage'])->name('CustomerPage')->middleware(SessionAuthenticate::class);
Route::get('/ProductPage',[ProductController::class,'ProductPage'])->name('ProductPage')->middleware(SessionAuthenticate::class);
Route::get("/ProfilePage",[UserController::class,'ProfilePage'])->name('ProfilePage')->middleware(SessionAuthenticate::class);

//user
Route::post('/user-registration',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/user-login',[UserController::class,'UserLogin'])->name('UserLogin');
Route::get('/logout',[UserController::class,'UserLogout'])->name('UserLogout');
Route::post('/send-otp',[UserController::class,'SendOTPCode'])->name('SendOTPCode');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware(SessionAuthenticate::class);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware(SessionAuthenticate::class);
Route::post('/user-update',[UserController::class,'UserUpdate'])->middleware(SessionAuthenticate::class);

//Category
Route::post('/create-category',[CategoryController::class,'CategoryCreate'])->middleware(SessionAuthenticate::class);
Route::get('/create-list',[CategoryController::class,'CategoryList'])->middleware(SessionAuthenticate::class);
Route::post('/delete-category',[CategoryController::class,'CategoryDelete'])->middleware(SessionAuthenticate::class);
Route::post('/category-by-id',[CategoryController::class,'CategoryById'])->middleware(SessionAuthenticate::class);
Route::post('/update-category',[CategoryController::class,'CategoryUpdate'])->middleware(SessionAuthenticate::class);

//Customer
Route::post('/create-customer',[CustomerController::class,'CustomerCreate'])->middleware(SessionAuthenticate::class);
Route::get('/list-customer',[CustomerController::class,'CustomerList'])->middleware(SessionAuthenticate::class);
Route::post('/delete-customer',[CustomerController::class,'CustomerDelete'])->middleware(SessionAuthenticate::class);
Route::post('/update-customer',[CustomerController::class,'CustomerUpdate'])->middleware(SessionAuthenticate::class);
Route::post('/customer-by-id',[CustomerController::class,'CustomerById'])->middleware(SessionAuthenticate::class);

//Product
Route::post('/create-product',[ProductController::class,'ProductCreate'])->middleware(SessionAuthenticate::class);
Route::get('/list-product',[ProductController::class,'ProductList'])->middleware(SessionAuthenticate::class);
Route::post('/update-product',[ProductController::class,'ProductUpdate'])->middleware(SessionAuthenticate::class);
Route::post('/delete-product',[ProductController::class,'ProductDelete'])->middleware(SessionAuthenticate::class);
Route::post('/product-by-id',[ProductController::class,'ProductById'])->middleware(SessionAuthenticate::class);

//Invoice
Route::post('/create-invoice',[InvoiceController::class,'InvoiceCreate'])->middleware(SessionAuthenticate::class);
Route::get('/select-invoice',[InvoiceController::class,'InvoiceSelect'])->middleware(SessionAuthenticate::class);
Route::post('/details-invoice',[InvoiceController::class,'InvoiceDetails'])->middleware(SessionAuthenticate::class);
Route::post('/delete-invoice',[InvoiceController::class,'InvoiceDelete'])->middleware(SessionAuthenticate::class);

//Dashboard
Route::get('/summary',[DashboardController::class,'Summary'])->middleware(SessionAuthenticate::class);
