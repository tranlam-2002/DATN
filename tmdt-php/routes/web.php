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
use App\Http\Controllers\Services\UploadService;
use App\Http\View\Composers\MenuComposer;
use App\Models\Slider;

Route::get('/', function () {
   return view('welcome');
});


Route::get('/home', [HomeController::class,'index'])->name('home');

Route::get('/admin/users/login', [LoginController::class,'index'])->name('login');

Route::post('/admin/users/login/store', [LoginController::class,'store']);

Route::middleware(['auth'])->group(function (){
   
   Route::prefix('admin')->group(function(){
      Route::get('/', [MainController::class,'index'])->name('admin');
      Route::get('main', [MainController::class,'index']);

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

Route::get('/', [MainController::class,'index']);
Route::post('/services/load-product', [MainController::class,'loadProduct']); 

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [ProductController::class,'index']);

Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);