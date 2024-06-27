@extends('welcome')
  <link rel="stylesheet" href="{{ asset('/template/css/product.css') }}">
@section('content')
    <div class="container ">
        <div class="p-b-30 p-t-40">
            <h2 class="ltext-105 txt-center respon1" style="color: black;  font-family: 'PhpDebugbarFontAwesome';">DANH MỤC SẢN PHẨM</h2>
        </div>
        @foreach($menus as $index => $menu)

            <div class="menu-section" style="background-color: {{ $colors[$index % count($colors)] }};">
                <div class="p-b-32">
                    <h3 class="ltext-105 txt-center respon1">
                        {{ $menu->name }}
                    </h3>
                </div>

                <div class="tab01">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#menu-{{ $menu->id }}" role="tab" aria-expanded="true">All</a>
                        </li>
                        @foreach($menu->children as $child)
                            <li class="nav-item p-b-10">
                                <a class="nav-link" data-toggle="tab" href="#menu-{{ $child->id }}" role="tab" aria-expanded="true">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content p-t-50">
                        <div class="tab-pane fade show active" id="menu-{{ $menu->id }}" role="tabpanel" aria-expanded="true">
                            <div class="wrap-slick2">
                                <div class="slick2">
                                    @foreach($menu->products as $product)
                                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                            <div class="block2">
                                                <div class="block2-pic hov-img0">
                                                    <img src="{{$product->thumb}}" alt="{{$product->name}}">
                                                    <a href="/san-pham/{{$product->id}}-{{ Str::slug($product->name, '-')}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                                        Xem thêm
                                                    </a>
                                                </div>
                                                <div class="block2-txt flex-w flex-t p-t-14">
                                                    <div class="block2-txt-child1 flex-col-l">
                                                        <a href="/san-pham/{{$product->id}}-{{ Str::slug($product->name, '-')}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                            {{$product->name}}
                                                        </a>
                                                        <span class="stext-105 cl3">
                                                            {!! \App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="arrow-slick2 prev-slick2 slick-arrow" style="">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                </button>
                                <button class="arrow-slick2 next-slick2 slick-arrow" style="">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                        @foreach($menu->children as $child)
                            <div class="tab-pane fade" id="menu-{{ $child->id }}" role="tabpanel" aria-expanded="true">
                                <div class="wrap-slick2">
                                    <div class="slick2">
                                        @foreach($child->products as $product)
                                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                                <div class="block2">
                                                    <div class="block2-pic hov-img0">
                                                        <img src="{{$product->thumb}}" alt="{{$product->name}}">
                                                        <a href="/san-pham/{{$product->id}}-{{ Str::slug($product->name, '-')}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                                            Quick View
                                                        </a>
                                                    </div>
                                                    <div class="block2-txt flex-w flex-t p-t-14">
                                                        <div class="block2-txt-child1 flex-col-l">
                                                            <a href="/san-pham/{{$product->id}}-{{ Str::slug($product->name, '-')}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                                {{$product->name}}
                                                            </a>
                                                            <span class="stext-105 cl3">
                                                                {!! \App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="arrow-slick2 prev-slick2 slick-arrow" style="">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    </button>
                                    <button class="arrow-slick2 next-slick2 slick-arrow" style="">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection