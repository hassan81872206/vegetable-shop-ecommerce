<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ShartController;

Route::get('/', [MainController::class , 'welcome'])->name("welcome");
Route::get('/shop', [MainController::class , 'shop'])->name("shop");
Route::get('/shopDetails/{product}', [MainController::class , 'shopDetails'])->name("shopDetails");
Route::get('/shop/{categorie}', [MainController::class , 'shopPage']);
Route::post('/search' , [MainController::class , 'search']);
Route::post('/addToCart/{product}' , [CartController::class , 'addToCart']);


// Route for Guest
Route::middleware(['guest'])->group(function(){
    Route::get('/login' , [AuthController::class , 'loginPage'])->name("login");
    Route::post('/register' , [AuthController::class , 'register'])->name("registerAction");
    Route::post('/login' , [AuthController::class , 'login'])->name("loginAction");

    // Reset Password
    Route::view('/forgot-password','auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class , 'passwordEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class , 'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class , "passwordUpdate"])->name('password.update');
});


// Route for auth
Route::middleware(['auth' , 'verified'])->group(function(){
    Route::get('/logout' , [AuthController::class , 'logout'])->name("logout");
    Route::get('/profile' , [AuthController::class , 'profile'])->name("profile");
    Route::get('/logout' , [AuthController::class , 'logout'])->name("logout");
    Route::get('/cart' , [CartController::class , "cartPage"])->name("cart");
    Route::delete("/cart/{cart}" , [CartController::class, 'deleteCart']);
    Route::post('/saveSession/{price}/{quantite}/{product}' , [PaymentController::class , 'saveSession'])->name('saveSession');
    Route::post('/savSession/{price}' , [PaymentController::class , 'savSession'])->name('saveSession');
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('cartCheckout');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
    Route::post("/feedback/{user}/{product}" , [MainController::class , "feedback"])->name("feedback");



    // Route for Admin
    Route::middleware(['isAdmin'])->group(function(){
        Route::get('/adminDashboard' , [AdminController::class , 'dashboard'])->name("adminDashboard");
        Route::resource('categories', CategorieController::class);  
        Route::resource('products' , ProductController::class); 
        Route::get('/products/addDiscount/{product}' , [ProductController::class , 'addDiscountPage'])->name("products.addDiscount"); 
        Route::post('/products/addDiscount/{product}' , [ProductController::class , 'addDiscount'])->name("products.addDiscount"); 
        Route::resource("customers" , AdminCustomerController::class);
        Route::get('/sales-data', [ShartController::class , "lineShart" ]);
        Route::get('/top-selling-products', [ShartController::class, 'topSellingProducts']);
        Route::get('/sales-by-category', [ShartController::class, 'salesByCategory']);
        Route::get('/monthly-sales', [ShartController::class, 'monthlySales']);
        Route::get('/top-customers', [ShartController::class, 'topCustomers']);
        Route::get('/daily-orders', [ShartController::class, 'dailyOrders']);
        Route::get('/weekly-sales', [ShartController::class, 'weeklySales']);
        Route::get('/weekly-orders', [ShartController::class, 'weeklyOrders']);

    });
});


// Email Verification
Route::get('/email/verify', [AuthController::class , 'noticeVerify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',[AuthController::class , 'emailVerify'])->middleware(['auth', 'signed'])->name('verification.verify'); 
Route::post('/email/verification-notification',[AuthController::class , 'resendEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');



