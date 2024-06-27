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
         $colors = [ 
            '#3498db', // Màu Xanh Dương
            '#2ecc71', // Màu Xanh Đậm
            '#6c7ae0', //  Màu Xanh Dương Đậm
            '#f1c40f', // Màu Vàng
            '#e74c3c', // Màu Cảm Đỏ
            '#e91e63', // Màu Hồng Đậm
            ];
        return view('home',[
            "title"=> "Shop Bán Đồ Điện Tử Thông Minh",
            "sliders"=> $this->slider->show(),
            "menus"=> $this->menu->show(),
            "products"=>$this-> product->get(),
            'colors' => $colors,
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
    public function show()
    {
        $menus = Menu::with(['products', 'children.products'])->where('parent_id', 0)->get();
          $firstMenu = $menus->first();
          $colors = [
            '#3498db', // Màu Xanh Dương
            '#2ecc71', // Màu Xanh Đậm
            '#6c7ae0', //  Màu Xanh Dương Đậm
            '#f1c40f', // Màu Vàng
            '#e74c3c', // Màu Cảm Đỏ
            '#e91e63', // Màu Hồng Đậm
            ]; 
        return view('product', compact('menus','firstMenu', 'colors'), [
            'title' => 'Danh sách sản phẩm'
        ]);
    }
    
    public function category()
    {
        $menus = Menu::with(['products', 'children.products'])->where('parent_id', 0)->get();
          $firstMenu = $menus->first();
          $colors = [
            '#3498db', // Màu Xanh Dương
            '#2ecc71', // Màu Xanh Đậm
            '#6c7ae0', //  Màu Xanh Dương Đậm
            '#f1c40f', // Màu Vàng
            '#e74c3c', // Màu Cảm Đỏ
            '#e91e63', // Màu Hồng Đậm
            ]; 
        return view('products.category', compact('menus','firstMenu', 'colors'), [
            'title' => 'Danh sách sản phẩm'
        ]);
    }
}