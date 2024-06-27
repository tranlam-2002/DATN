@extends('welcome')

@section('content')
<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="mtext-111 cl2 p-b-16">
                    {{ $promotion->name }}
                </h3>
                <p class="stext-113 cl5 p-b-26">
                    {{ $promotion->description }}
                </p>
                <div class="p-t-20 p-b-20">
                    <div class="hov-img0">
                        <img src="{{ $promotion->thumb }}" alt="IMG" style="width: 100%;">
                    </div>
                </div>
                <span class="stext-113 cl8 p-t-20 ">
                    Thời gian bắt đầu: {{ $promotion->updated_at->format('d/m/Y H:i') }}
                </span>
                <div class="stext-113 cl5 p-b-26 p-t-20">
                    {!! $promotion->content !!}
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
