<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\PromotionController;
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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Services\UploadService;
use App\Http\Controllers\UserController;
use App\Http\View\Composers\MenuComposer;
use App\Models\Promotion;
use App\Models\Slider;
use Monolog\Handler\RotatingFileHandler;

Route::get('/welcome', function () {
   return view('welcome');
});


Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/home/product', [HomeController::class, 'show']);
Route::get('/home/category', [HomeController::class, 'category'])->name('home.category');
Route::post('/services/load-product', [HomeController::class,'loadProduct']); 

Route::get('admin', [LoginController::class,'index'])->name('logon');
Route::post('/logon/store', [LoginController::class,'store']);
Route::post('/signout', [LoginController::class, 'signout'])->name('signout');
     
Route::prefix('admin')->middleware(['admin'])->group(function(){
      Route::get('main', [App\Http\Controllers\Admin\MainController::class,'index'])->name('main');
      Route::get('dashboard', [App\Http\Controllers\Admin\MainController::class, 'index'])->name('dashboard');
   #menu
      Route::prefix('menus')->group(function(){
         Route::get('add', [MenuController::class, 'create']);
         Route::post('add', [MenuController::class, 'store']);
         Route::get('list', [MenuController::class, 'index']); 
         Route::get('edit/{menu}', [MenuController::class, 'show']);
         Route::post('edit/{menu}', [MenuController::class, 'update']);
         Route::DELETE('destroy', [MenuController::class, 'destroy']);
         Route::get('search', [MenuController::class, 'search'])->name('admin.menus.searchMenus');
         
      }); 
   #sanpham
      Route::prefix('products')->group(function(){
        Route::get('add', [ProductsController::class, 'create']);
        Route::post('add', [ProductsController::class, 'store']);  
        Route::get('list', [ProductsController::class,'index']);
        Route::get('edit/{product}', [ProductsController::class, 'show']);
         Route::post('edit/{product}', [ProductsController::class, 'update']);
         Route::DELETE('destroy', [ProductsController::class, 'destroy']);
         Route::get('search', [ProductsController::class, 'search'])->name('admin.products.search');

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
   #khuyenmai
         Route::get('promotions', [App\Http\Controllers\Admin\PromotionController::class, 'create'])->name('admin.promotions.create');
         Route::get('promotions/create', [App\Http\Controllers\Admin\PromotionController::class, 'index'])->name('admin.promotions.index');
         Route::post('promotions', [App\Http\Controllers\Admin\PromotionController::class, 'store'])->name('admin.promotions.store');
         Route::get('promotions/edit/{promotion}', [App\Http\Controllers\Admin\PromotionController::class, 'show']);
         Route::post('promotions/edit/{promotion}', [App\Http\Controllers\Admin\PromotionController::class, 'update']);
         Route::DELETE('promotions/destroy', [App\Http\Controllers\Admin\PromotionController::class, 'destroy']);
   #upload
       Route::post('upload/services', [UploadController::class,'store']);
   #Cart
       Route::get('customers', [\App\Http\Controllers\Admin\CartController::class, 'index']);
       Route::get('customers/view/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'show']);
       Route::Delete('customers/destroy', [\App\Http\Controllers\Admin\CartController::class, 'destroy']);
       Route::get('customers/status', [\App\Http\Controllers\Admin\CartController::class, 'status'])->name('admin.carts.index');
       Route::put('customers/{customerId}/updateStatus', [\App\Http\Controllers\Admin\CartController::class, 'updateStatus'])->name('admin.carts.updateStatus');
       Route::get('customers/{id}/export-pdf', [\App\Http\Controllers\Admin\CartController::class, 'exportPDF'])->name('admin.customers.pdf');
       Route::get('customers/search', [\App\Http\Controllers\Admin\CartController::class, 'search'])->name('admin.customers.search');
       Route::get('customers/searchs', [\App\Http\Controllers\Admin\CartController::class, 'searchXLDH'])->name('admin.customers.searchs');

       
   #User khach hang   
       Route::get('users', [\App\Http\Controllers\Admin\UserControllers::class, 'index']);
      //  Route::get('users/view{users}', [\App\Http\Controllers\Admin\UserControllers::class::class, 'show']);
       Route::Delete('users/destroy', [\App\Http\Controllers\Admin\UserControllers::class, 'destroy']);

   // Route để quản lý thông tin liên hệ
      Route::get('contacts/', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
      Route::get('contacts/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
      Route::DELETE('contact/destroy', [\App\Http\Controllers\Admin\ContactController::class, 'destroy']);
    
});
   
  


Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class,'postLogin'])->name('postLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class,'register'])->name('register');
Route::post('/register', [UserController::class,'postRegister'])->name('postRegister');
Route::get('/forgot_password', [UserController::class,'forgot_password'])->name('forgot_password');
Route::post('/forgot_password', [UserController::class,'postForgot_password'])->name('postForgot_password');


  
Route::get('/', [MainController::class,'index']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/services/load-product', [MainController::class,'loadProduct']); 

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']); 
Route::get('san-pham/{id}-{slug}.html', [ProductController::class,'index']);

Route::get('/contact',[ContactController::class, 'contact'])->name('contact');
Route::post('/contact',[ContactController::class, 'postContact'])->name('postContact');

Route::get('/promotions', [PromotionsController::class, 'showPromotions']);
Route::get('/promotions/{id}', [PromotionsController::class, 'show']);

//QLTK
Route::group(['middleware' => ['auth']], function () {
   // Route::get('/layouts',[AccountController::class,'user'])->name('layouts');
   Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');
    Route::get('/account/change-password', [AccountController::class, 'showChangePasswordForm'])->name('account.change-password');
    Route::post('/account/change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');
    Route::get('/account/orders', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/account/orders/{id}', [AccountController::class, 'show'])->name('orders.show');
    Route::put('/account/orders/{customerId}/showPut', [AccountController::class, 'showPut'])->name('orders.showPut');
    Route::delete('/account/orders/{id}', [AccountController::class, 'destroy'])->name('orders.destroy');

    
    // Customer
    Route::post('add-cart', [CartController::class, 'index']);
    Route::get('carts', [CartController::class, 'show']);
    Route::post('update-cart', [CartController::class, 'update']);
    Route::get('carts/delete/{id}', [CartController::class, 'remove']);
    Route::post('carts', [CartController::class, 'addCart']);
    
    //thanhtoan
    Route::get('/vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
});