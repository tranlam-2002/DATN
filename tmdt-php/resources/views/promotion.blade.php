@extends('welcome')

@section('content')
<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-20">
            @foreach($promotions as $promotion)
            <div class="col-12 p-b-90">
                <div class="row">
                    <div class="col-md-7 col-lg-8 order-md-2">
                        <div class="p-t-7 p-l-15 p-r-15">
                            <h3 class="mtext-111 cl2 p-b-16">
                                {{ $promotion->name }}
                            </h3>
                            <p class="stext-113 cl5 p-b-26">
                                {{ $promotion->description }}
                            </p>
                            <div class="d-flex align-items-center">
                                <span class="stext-111 cl8">
                                    Thời gian bắt đầu: {{ $promotion->updated_at->format('d/m/Y H:i') }}
                                </span>
                                <a href="{{ url('/promotions/' . $promotion->id) }}" class="btn btn-primary ml-3" style="font-size: 14px;">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4 order-md-1 m-lr-auto">
                        <div class="how-bor2">
                            <div class="hov-img0">
                                <img src="{{ $promotion->thumb }}" alt="IMG" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
