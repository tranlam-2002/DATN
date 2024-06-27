<?php
namespace App\Http\Services\Promotion;

use App\Models\Promotion;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class PromotionServices{
    public function create($request){
        try{
            Promotion::create($request->input());
            Session::flash('success','Thêm khuyến mại mới thành công');
        }
        catch(\Exception $err){
            Session::flash('error', 'Thêm khuyến mại thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get(){
        return Promotion::orderByDesc('id')->paginate(15);
    }
     public function update($request, $promotion){
        try{
            $promotion->fill($request->input());
            $promotion->save();
            Session::flash('success','Cập Nhật khuyến mại thành công ');
          
        }
        catch(\Exception $err){
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
      $promotion = Promotion::where('id',$request->input('id'))->first();
      if($promotion){
        $path = str_replace('storage', 'public', $promotion->thumb);
        Storage::delete($path);
        $promotion->delete();
        return true;
      }
      return false;
    }    
    public function show(){
        return Promotion::where('active', 1)->get();
    }
}