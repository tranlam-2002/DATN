<?php
namespace App\Http\Services\Product;

use App\Models\Menu;

class ProductAdminService{
    public function getMenu(){
        return Menu::where("active", 1)->get();
    }
    
    public function isVaildPrice(){
        // if($request->input('price') != 0 && $request->input('price_sale') != 0
        // && $request->input('price_sale') >= $request->input('price')
        // ){
        //     Sesion::flash('error', 'giá sản phẩm nhỏ hơn giá gốc');
        //     return false;
        // }
    }
    public function insert($request){
        
    }
}