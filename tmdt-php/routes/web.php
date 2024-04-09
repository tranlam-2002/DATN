<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Users\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;


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
   }); 
   });
   
  
});