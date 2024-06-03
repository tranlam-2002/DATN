<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Product;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Services\UploadService;
use App\Http\Controllers\UserController;
use App\Http\View\Composers\MenuComposer;
use App\Models\Slider;

Route::get('/welcome', function () {
   return view('welcome');
});


Route::get('/home', [HomeController::class,'index'])->name('home');
Route::post('/services/load-product', [HomeController::class,'loadProduct']); 


Route::middleware(['auth'])->group(function (){
   
   Route::prefix('admin')->group(function(){
      Route::get('/', [App\Http\Controllers\Admin\MainController::class,'index'])->name('admin');
      Route::get('/users/login', [LoginController::class,'index'])->name('login');
      Route::post('/users/login/store', [LoginController::class,'store']);
      Route::get('main', [App\Http\Controllers\Admin\MainController::class,'index']);

   #menu
      Route::prefix('menus')->group(function(){
         Route::get('add', [MenuController::class, 'create']);
         Route::post('add', [MenuController::class, 'store']);
         Route::get('list', [MenuController::class, 'index']);      
         Route::get('edit/{menu}', [MenuController::class, 'show']);
         Route::post('edit/{menu}', [MenuController::class, 'update']);
         Route::DELETE('destroy', [MenuController::class, 'destroy']);
 
      }); 
   #sanpham
      Route::prefix('products')->group(function(){
        Route::get('add', [ProductsController::class, 'create']);
        Route::post('add', [ProductsController::class, 'store']);  
        Route::get('list', [ProductsController::class,'index']);
        Route::get('edit/{product}', [ProductsController::class, 'show']);
         Route::post('edit/{product}', [ProductsController::class, 'update']);
         Route::DELETE('destroy', [ProductsController::class, 'destroy']);
   });
   #Slider
   Route::prefix('sliders')->group(function(){
        Route::get('add', [SliderController::class, 'create']);
        Route::post('add', [SliderController::class, 'store']);  
        Route::get('list', [SliderController::class,'index']);
        Route::get('edit/{slider}', [SliderController::class, 'show']);
         Route::post('edit/{slider}', [SliderController::class, 'update']);
         Route::DELETE('destroy', [SliderController::class, 'destroy']);
   });
   #upload
       Route::post('upload/services', [UploadController::class,'store']);
   #Cart
       Route::get('customers', [\App\Http\Controllers\Admin\CartController::class, 'index']);
       Route::get('customers/view/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'show']);
       Route::Delete('customers/destroy', [\App\Http\Controllers\Admin\CartController::class, 'destroy']);
      });
   
  
});

Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class,'postLogin'])->name('postLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class,'register'])->name('register');
Route::post('/register', [UserController::class,'postRegister'])->name('postRegister');
Route::get('/forgot_password', [UserController::class,'forgot_password'])->name('forgot_password');
Route::post('/forgot_password', [UserController::class,'postForgot_password'])->name('postForgot_password');
// Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

  
Route::get('/', [MainController::class,'index']);
Route::post('/services/load-product', [MainController::class,'loadProduct']); 

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']); 
Route::get('san-pham/{id}-{slug}.html', [ProductController::class,'index']);

Route::get('/contact',[ContactController::class, 'contact'])->name('contact');;

Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);