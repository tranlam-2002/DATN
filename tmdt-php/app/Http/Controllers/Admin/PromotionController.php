<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Promotion\PromotionRequest;
use App\Http\Services\Promotion\PromotionServices;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PromotionController extends Controller
{
    protected $promotion;
    public function __construct(PromotionServices $promotion){
        $this->promotion = $promotion;
    }
    public function index(){
        return view("admin.promotion.list",[
            'title' => 'Danh sách khuyến mại',
            'promotions'=> $this->promotion->get(),
        ]);
    }
    public function create(){
        return view("admin.promotion.add",[
            'title' => 'Thêm khuyến mại'
        ]);
    }
    public function store(PromotionRequest $request)
    {
        try {
            Promotion::create($request->validated());
            Session::flash('success', 'Thêm khuyến mại mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm khuyến mại thất bại');
            Log::info($err->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.promotions.create');
    }
    public function show(Promotion $promotion){
      return view('admin.promotion.edit',[
        'title'=>'Chỉnh sửa khuyến mại',
        'promotion'=>$promotion,
      ]);  
    }
    public function update(PromotionRequest $request, Promotion $promotion){
         $this->promotion->update($request, $promotion);
        if($request){
            return redirect('/admin/promotions/create');
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $result = $this->promotion->delete($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công khuyến mại'
            ]);
        }
        return response()->json(['error' => true]);
    }
}