<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderServices;
use App\Http\Services\Product\ProductService;
use App\Models\Menu;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    //
    protected $slider;
    protected $menu;
    protected $product;
    public function __construct(SliderServices $slider, MenuService $menu, ProductService $product){
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }
    public function index(){
        return view('home',[
            "title"=> "Shop Bán Đồ Điện Tử Thông Minh",
            "sliders"=> $this->slider->show(),
            "menus"=> $this->menu->show(),
            "products"=>$this-> product->get(),
        ]);
    }
        public function loadProduct(Request $request){
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if(count($result) != 0){
            $html = view('products.list', ['products'=> $result])->render();
            
            return response()->json(['html' => $html]);
        }
        return response()->json(['html' => '']);
    }
}