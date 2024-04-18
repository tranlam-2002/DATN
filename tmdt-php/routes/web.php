<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\Users\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Product;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Services\UploadService;

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
      #sanpham
      Route::prefix('products')->group(function(){
        Route::get('add', [ProductsController::class, 'create']);
        Route::post('add', [ProductsController::class, 'store']);
        Route::get('list', [ProductsController::class, 'index']);    
   });
   #upload
       Route::post('upload/services', [UploadController::class,'store']);
   });
   
  
});