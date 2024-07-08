@extends('welcome')

@section('content')
    <div class="container">
        <div class="p-b-30 p-t-40">
             <h2 class="ltext-105 txt-center respon1" style="color: black;  font-family: 'PhpDebugbarFontAwesome';">Kết quả tìm kiếm cho: {{ $query }}</h2>
        </div>
        @if($products->isEmpty())
            <p>Không tìm thấy kết quả nào</p>
        @else
            <div class="row isotope-grid">
                @foreach($products as $key => $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2 product-card">
                        <div class="block2-pic hov-img0">
                            <img src="{{$product->thumb}}" alt="{{$product->name}}">
                            <a href="/san-pham/{{$product->id}}-{{ Str::slug($product->name, '-')}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                Xem thêm
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="/san-pham/{{$product->id}}-{{ Str::slug($product->name, '-')}}.html"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{$product->name}}
                                </a>

                                <span class="stext-105 cl3">
                                    {!! \App\Helpers\Helper::price( $product->price, $product->price_sale) !!}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection