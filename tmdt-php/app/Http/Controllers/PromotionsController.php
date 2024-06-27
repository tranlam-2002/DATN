<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function showPromotions() {
    $promotions = Promotion::all();
    return view('promotion', compact('promotions'), [
        'title'=>'Chương trình khuyến mại'
    ]);
  }
  public function show($id) {
    $promotion = Promotion::findOrFail($id);
    return view('promotion-detail', compact('promotion'), [
        'title'=>'Chi tiết chương trình khuyến mại'
    ]);
}

}