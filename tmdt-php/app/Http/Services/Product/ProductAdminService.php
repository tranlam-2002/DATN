<?php
namespace App\Http\Services\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
use App\Models\Product;


class ProductAdminService{
    public function getMenu(){
        return Menu::where("active", 1)->get();
    }
    
    public function isValidPrice($request){
        if($request->input('price') != 0 && $request->input('price_sale') != 0
        && $request->input('price_sale') >= $request->input('price')
        ){
            Session::flash('error', 'giá sản phẩm nhỏ hơn giá gốc');
            return false;
        }
        
        if($request->input('price_sale') != 0 && (int)$request->input('price') == 0 ){
           Session::flash('error', 'vui lòng nhập giá gốc');
           return false;
        }
        return true;
    }
    public function create($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false) return false;
        try{
        //   $request->exception('_token');
          Product::create($request->all());
          Session::flash('success','Thêm sản phẩm thành công');
        }
        catch(\Exception $err){
            Session::flash('error', 'Thêm sản phẩm không thành công');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    
    public function get(){
        return Product::with('menu')
        ->orderByDesc('id')->paginate(15);
    }
    public function update($request, $product){
          $isValidPrice = $this->isValidPrice($request);
         if($isValidPrice == false) return false;
         

        try{
        $product->fill($request->input());
        $product->save();
        Session::flash('success','Cập nhật thành công');
        }
        catch(\Exception $err){
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
       public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }
        return false;
       }
}   