<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderServices;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderServices $slider){
        $this->slider = $slider;
    }
    public function index(){
        return view("admin.slider.list", [
            "title"=> 'Danh sách Slider mới nhất',
            'sliders'=> $this->slider->get(),
        ]);
    }
    public function create(){
        return view("admin.slider.add",[
            'title' => 'Thêm slider'
        ]);
    }
    public function store(SliderRequest $request){
        $this->slider->create($request);
        return redirect()->back();
    }
    public function show(Slider $slider){
      return view('admin.slider.edit',[
        'title'=>'Chỉnh sửa slider',
        'slider'=> $slider,
      ]);  
    }
    public function update(SliderRequest $request, Slider $slider){
         $this->slider->update($request, $slider);
        if($request){
            return redirect('/admin/sliders/list');
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $result = $this->slider->delete($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công Slider'
            ]);
        }
        return response()->json(['error' => true]);
    }
}